<?php

namespace App\Console\Commands;

use App\Models\Joke;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class JokeImport extends Command
{
    protected $signature = 'joke:import {--count=10 : Number of jokes to import}';

    protected $description = 'Import jokes from the joke API and store them in the database';

    public function handle()
    {
        $count = $this->option('count');
        $importedCount = 0;

        $this->info("Starting to import {$count} jokes...");

        while ($importedCount < $count) {
            $response = Http::get('https://v2.jokeapi.dev/joke/Any');

            if ($response->successful()) {
                $jokeData = $response->json();

                $joke = new Joke;
                $joke->category = $jokeData['category'];
                $joke->lang = $jokeData['lang'];

                if ($jokeData['type'] === 'single') {
                    $joke->joke = $jokeData['joke'];
                } else {
                    $joke->setup = $jokeData['setup'];
                    $joke->delivery = $jokeData['delivery'];
                }

                $joke->save();

                $importedCount++;
                $this->info("Imported joke {$importedCount} of {$count}");
            } else {
                $this->error('Failed to fetch joke from API. Retrying...');
            }

            // Add a small delay to avoid overwhelming the API
            usleep(500000); // 0.5 second delay
        }

        $this->info('Joke import completed successfully.');

        return 0;
    }
}
