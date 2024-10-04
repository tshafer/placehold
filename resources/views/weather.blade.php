<x-layout>
    <div class="container mx-auto px-4 py-12">
        <h1 class="text-6xl font-extrabold mb-8 text-center text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-pink-300">Weather API</h1>

        <div class="bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 p-8 rounded-2xl shadow-lg bg-no-repeat bg-cover">
            <h2 class="text-3xl font-semibold mb-6 text-white">Usage Guide</h2>
            <p class="text-xl text-white/90 mb-8">Get accurate weather data with our powerful API. Here's how to get started:</p>

            <div class="space-y-12">
                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Basic Usage</h3>
                    <div class="bg-black/30 p-4 rounded-lg">
                        <code class="text-green-300 text-sm break-all">
                            {{ route('weather', ['city' => 'London', 'country' => 'GB']) }}
                        </code>
                    </div>
                    <p class="text-white/90 mt-4">This request will return weather data for London, UK.</p>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Query Parameters</h3>
                    <ul class="list-disc list-inside text-white/90 space-y-2 ml-4">
                        <li><span class="font-semibold">city</span>: Name of the city (required)</li>
                        <li><span class="font-semibold">country</span>: Two-letter country code (required)</li>
                        <li><span class="font-semibold">units</span>: Units of measurement (metric, imperial, or standard) (optional)</li>
                        <li><span class="font-semibold">lang</span>: Two-letter language code (optional)</li>
                        <li><span class="font-semibold">forecast_days</span>: Number of forecast days (1-7) (optional)</li>
                        <li><span class="font-semibold">include_hourly</span>: Include hourly forecast (boolean) (optional)</li>
                        <li><span class="font-semibold">include_alerts</span>: Include weather alerts (boolean) (optional)</li>
                        <li><span class="font-semibold">include_historical</span>: Include historical data (boolean) (optional)</li>
                        <li><span class="font-semibold">include_uv_index</span>: Include UV index (boolean) (optional)</li>
                    </ul>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Response Format</h3>
                    <div class="bg-black/30 p-4 rounded-lg">
                        <pre class="text-green-300 text-sm overflow-x-auto">
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
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Example Usage</h3>
                    <p class="text-white/90 mb-4">Here's an example of how to use the API with parameters:</p>
                    <div class="bg-black/30 p-4 rounded-lg mb-4">
                        <code class="text-green-300 text-sm break-all">
                            {{ route('weather', ['city' => 'London', 'country' => 'GB', 'units' => 'metric', 'forecast_days' => 3]) }}
                        </code>
                    </div>
                    <p class="text-white/90">This request will return weather data for London, UK, in metric units, with a 3-day forecast.</p>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">Error Handling</h3>
                    <p class="text-white/90 mb-4">In case of an error, the API will return a JSON response with an error message:</p>
                    <div class="bg-black/30 p-4 rounded-lg">
                        <pre class="text-green-300 text-sm overflow-x-auto">
{
    "status": "error",
    "message": "Error description"
}
                        </pre>
                    </div>
                </section>

                <section>
                    <h3 class="text-2xl font-semibold mb-4 text-white">API Limits</h3>
                    <p class="text-white/90 mb-4">To ensure fair usage, this API is rate-limited. Please adhere to the following limits:</p>
                    <ul class="list-disc list-inside text-white/90 space-y-2 ml-4">
                        <li><span class="font-semibold">60 requests</span> per minute</li>
                        <li><span class="font-semibold">1000 requests</span> per day</li>
                    </ul>
                </section>
            </div>
        </div>
    </div>
</x-layout>
