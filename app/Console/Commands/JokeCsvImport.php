<?php

namespace App\Console\Commands;

use App\Models\Joke;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;

class JokeCsvImport extends Command
{
    protected $signature = 'joke:json-import {file : Path to the JSON file}';

    protected $description = 'Import jokes from a JSON file and store them in the database';

    public function handle()
    {
        $filePath = $this->argument('file');

        if (! File::exists($filePath)) {
            $this->error("The file {$filePath} does not exist.");

            return 1;
        }

        $jsonData = json_decode(file_get_contents($filePath), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Failed to parse JSON file: '.json_last_error_msg());

            return 1;
        }

        $importedCount = 0;

        foreach ($jsonData as $jokeData) {
            $joke = new Joke;
            $joke->body = Arr::get($jokeData, 'body', null);
            $joke->title = Arr::get($jokeData, 'title', null);
            $joke->category = Arr::get($jokeData, 'category', null);
            $joke->rating = Arr::get($jokeData, 'rating', null);

            $joke->save();

            $importedCount++;
            $this->info("Imported joke {$importedCount}");
        }

        $this->info("JSON import completed. Total jokes imported: {$importedCount}");

        return 0;
    }
}
