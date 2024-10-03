<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class JokesController extends Controller
{
    private const JOKE_API_URL = 'https://v2.jokeapi.dev/joke/Any';

    public const MAX_JOKE_ID = 1369;

    private const FALLBACK_JOKES = [
        'Chuck Norris is not amused.',
        'Why don\'t scientists trust atoms? Because they make up everything!',
        'Did you hear about the claustrophobic astronaut? He just needed a little space.',
        'Why don\'t eggs tell jokes? They\'d crack each other up.',
        'I told my wife she was drawing her eyebrows too high. She looked surprised.',
        'Why do bees have sticky hair? Because they use honeycombs.',
        'What do you call a fake noodle? An impasta.',
        'How do you organize a space party? You planet.',
        'Why did the scarecrow win an award? He was outstanding in his field.',
        'Why don\'t skeletons fight each other? They don\'t have the guts.',
        'What do you call a can opener that doesn\'t work? A can\'t opener.',
        'Why did the math book look so sad? Because it had too many problems.',
        'What do you call a bear with no teeth? A gummy bear.',
        'Why did the cookie go to the doctor? Because it was feeling crumbly.',
        'What do you call a sleeping bull? A bulldozer.',
        'Why did the golfer bring two pairs of pants? In case he got a hole in one.',
        'What do you call a pig that does karate? A pork chop.',
        'Why don\'t eggs tell jokes? They\'d crack each other up.',
        'What do you call a fake noodle? An impasta.',
        'Why did the scarecrow win an award? He was outstanding in his field.',
    ];

    public function __invoke(Request $request)
    {
        $id = $this->getRandomJokeId();

        return $this->getCachedJoke($id);
    }

    private function getRandomJokeId(): int
    {
        return Arr::random(range(1, self::MAX_JOKE_ID));
    }

    private function getCachedJoke(int $id): array
    {
        return Cache::tags('jokes')->rememberForever(
            $this->getCacheKey($id),
            fn () => $this->fetchJoke()
        );
    }

    private function getCacheKey(int $id): string
    {
        return md5('joke_'.$id);
    }

    private function fetchJoke(): array
    {
        $response = Http::get(self::JOKE_API_URL);

        if ($response->successful()) {
            return $this->parseJokeResponse($response->json());
        }

        return ['joke' => Arr::random(self::FALLBACK_JOKES)];
    }

    private function parseJokeResponse(array $json): array
    {
        $unnecessaryKeys = ['flags', 'error', 'safe', 'id', 'type', 'category', 'lang'];

        return Arr::except($json, $unnecessaryKeys);
    }
}
