<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class WeatherController extends Controller
{
    private const API_BASE_URL = 'http://api.openweathermap.org/data/2.5/';

    private const DEFAULT_CACHE_TIME = 3600; // 1 hour in seconds

    private $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.openweather.api_key');
    }

    public function __invoke(Request $request)
    {
        $validated = $this->validateRequest($request);

        if ($validated instanceof \Illuminate\Http\JsonResponse) {
            return $validated;
        }

        $cacheKey = $this->generateCacheKey($validated);

        return Cache::remember($cacheKey, self::DEFAULT_CACHE_TIME, function () use ($validated) {
            return $this->fetchWeatherData($validated);
        });
    }

    private function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'city' => 'required|string|max:255',
            'country' => 'required|string|size:2',
            'units' => 'in:metric,imperial,standard',
            'lang' => 'string|size:2',
            'forecast_days' => 'integer|min:1|max:7',
            'include_hourly' => 'boolean',
            'include_alerts' => 'boolean',
            'include_historical' => 'boolean',
            'include_uv_index' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 400);
        }

        return $validator->validated();
    }

    private function generateCacheKey(array $params): string
    {
        return 'weather_'.md5(json_encode($params));
    }

    private function fetchWeatherData(array $params)
    {
        $response = Http::get(self::API_BASE_URL.'forecast', [
            'q' => "{$params['city']},{$params['country']}",
            'appid' => $this->apiKey,
            'units' => $params['units'] ?? 'metric',
            'lang' => $params['lang'] ?? 'en',
            'cnt' => ($params['forecast_days'] ?? 1) * 8,
        ]);

        if (! $response->successful()) {
            Log::error('Weather API Error', ['response' => $response->body()]);

            return response()->json(['status' => 'error', 'message' => 'Unable to fetch weather data'], 500);
        }

        $data = $response->json();

        return $this->processWeatherData($data, $params);
    }

    private function processWeatherData(array $data, array $params)
    {
        $processedData = [
            'city' => $data['city']['name'],
            'country' => $data['city']['country'],
            'current' => $this->processCurrentWeather($data['list'][0]),
            'forecast' => $this->processForecastData($data['list'], $params['forecast_days'] ?? 1),
            'air_quality' => $this->getAirQualityData($params['city'], $params['country']),
            'sunrise' => Carbon::createFromTimestamp($data['city']['sunrise'])->toDateTimeString(),
            'sunset' => Carbon::createFromTimestamp($data['city']['sunset'])->toDateTimeString(),
        ];

        if ($params['include_hourly'] ?? true) {
            $processedData['hourly'] = $this->processHourlyData($data['list']);
        }

        if ($params['include_alerts'] ?? true) {
            $processedData['alerts'] = $this->getWeatherAlerts($params['city'], $params['country']);
        }

        if ($params['include_historical'] ?? true) {
            $processedData['historical'] = $this->getHistoricalData($params['city'], $params['country']);
        }

        if ($params['include_uv_index'] ?? true) {
            $processedData['uv_index'] = $this->getUVIndex($params['city'], $params['country']);
        }

        return response()->json([
            'status' => 'success',
            'data' => $processedData,
            'units' => $params['units'] ?? 'metric',
            'lang' => $params['lang'] ?? 'en',
            'timestamp' => now()->toDateTimeString(),
        ]);
    }

    private function processCurrentWeather(array $weatherData): array
    {
        return [
            'temperature' => $weatherData['main']['temp'],
            'feels_like' => $weatherData['main']['feels_like'],
            'humidity' => $weatherData['main']['humidity'],
            'pressure' => $weatherData['main']['pressure'],
            'wind_speed' => $weatherData['wind']['speed'],
            'wind_direction' => $weatherData['wind']['deg'],
            'description' => $weatherData['weather'][0]['description'],
            'icon' => $weatherData['weather'][0]['icon'],
            'clouds' => $weatherData['clouds']['all'],
            'visibility' => $weatherData['visibility'],
            'rain' => $weatherData['rain']['3h'] ?? 0,
            'snow' => $weatherData['snow']['3h'] ?? 0,
        ];
    }

    private function processForecastData(array $forecastData, int $days): array
    {
        return array_map([$this, 'processCurrentWeather'], array_slice($forecastData, 1, $days * 8, true));
    }

    private function getAirQualityData(string $city, string $country): ?array
    {
        $response = Http::get(self::API_BASE_URL.'air_pollution', [
            'q' => "{$city},{$country}",
            'appid' => $this->apiKey,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            return [
                'aqi' => $data['list'][0]['main']['aqi'],
                'components' => $data['list'][0]['components'],
            ];
        }

        return null;
    }

    private function processHourlyData(array $hourlyData): array
    {
        return array_map([$this, 'processCurrentWeather'], array_slice($hourlyData, 0, 24));
    }

    private function getWeatherAlerts(string $city, string $country): ?array
    {
        $response = Http::get(self::API_BASE_URL.'onecall', [
            'q' => "{$city},{$country}",
            'appid' => $this->apiKey,
            'exclude' => 'current,minutely,hourly,daily',
        ]);

        if ($response->successful()) {
            $data = $response->json();

            return $data['alerts'] ?? [];
        }

        return null;
    }

    private function getHistoricalData(string $city, string $country): ?array
    {
        $response = Http::get(self::API_BASE_URL.'onecall/timemachine', [
            'q' => "{$city},{$country}",
            'appid' => $this->apiKey,
            'dt' => now()->subDay()->timestamp,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            return $this->processCurrentWeather($data['current']);
        }

        return null;
    }

    private function getUVIndex(string $city, string $country): ?float
    {
        $response = Http::get(self::API_BASE_URL.'uvi', [
            'q' => "{$city},{$country}",
            'appid' => $this->apiKey,
        ]);

        if ($response->successful()) {
            $data = $response->json();

            return $data['value'];
        }

        return null;
    }
}
