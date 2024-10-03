<x-layout>
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold mb-8 text-center text-white">Weather API Documentation</h1>

        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-2xl shadow-lg mb-8">
            <h2 class="text-2xl font-semibold mb-4 text-white">Endpoint</h2>
            <code class="block bg-gray-800 text-green-400 p-4 rounded">GET {{ route('weather', ['city' => 'London', 'country' => 'GB']) }}</code>
        </div>

        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-2xl shadow-lg mb-8">
            <h2 class="text-2xl font-semibold mb-4 text-white">Query Parameters</h2>
            <ul class="list-disc list-inside text-white/90">
                <li><strong>city</strong> (required): Name of the city</li>
                <li><strong>country</strong> (required): Two-letter country code</li>
                <li><strong>units</strong> (optional): Units of measurement (metric, imperial, or standard)</li>
                <li><strong>lang</strong> (optional): Two-letter language code</li>
                <li><strong>forecast_days</strong> (optional): Number of forecast days (1-7)</li>
                <li><strong>include_hourly</strong> (optional): Include hourly forecast (boolean)</li>
                <li><strong>include_alerts</strong> (optional): Include weather alerts (boolean)</li>
                <li><strong>include_historical</strong> (optional): Include historical data (boolean)</li>
                <li><strong>include_uv_index</strong> (optional): Include UV index (boolean)</li>
            </ul>
        </div>

        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-2xl shadow-lg mb-8">
            <h2 class="text-2xl font-semibold mb-4 text-white">Response Format</h2>
            <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto">
{
    "status": "success",
    "data": {
        "city": "City Name",
        "country": "Country Code",
        "current": {
            // Current weather data
        },
        "forecast": [
            // Forecast data for requested days
        ],
        "air_quality": {
            // Air quality data
        },
        "sunrise": "YYYY-MM-DD HH:MM:SS",
        "sunset": "YYYY-MM-DD HH:MM:SS",
        "hourly": [
            // Hourly forecast data (if requested)
        ],
        "alerts": [
            // Weather alerts (if requested)
        ],
        "historical": {
            // Historical weather data (if requested)
        },
        "uv_index": 0.0 // UV index (if requested)
    },
    "units": "metric",
    "lang": "en",
    "timestamp": "YYYY-MM-DD HH:MM:SS"
}
            </pre>
        </div>

        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-2xl shadow-lg mb-8">
            <h2 class="text-2xl font-semibold mb-4 text-white">Example Usage</h2>
            <code class="block bg-gray-800 text-green-400 p-4 rounded mb-4">
GET {{ route('weather', ['city' => 'London', 'country' => 'GB', 'units' => 'metric', 'forecast_days' => 3]) }}
            </code>
            <p class="text-white/90">This request will return weather data for London, UK, in metric units, with a 3-day forecast.</p>
        </div>

        <div class="bg-white/10 backdrop-blur-md border border-white/20 p-8 rounded-2xl shadow-lg">
            <h2 class="text-2xl font-semibold mb-4 text-white">Error Handling</h2>
            <p class="text-white/90 mb-4">In case of an error, the API will return a JSON response with an error message:</p>
            <pre class="bg-gray-800 text-green-400 p-4 rounded overflow-x-auto">
{
    "status": "error",
    "message": "Error description"
}
            </pre>
        </div>
    </div>
</x-layout>
