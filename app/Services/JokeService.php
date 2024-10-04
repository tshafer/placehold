<?php

namespace App\Services;

use App\Models\Joke;

class JokeService
{
    public function getRandomJoke(string $category = 'Any'): array
    {
        $joke = $this->getJokeFromDatabase($category);

        return [
            'body' => $joke->body,
            'title' => $joke->title,
            'category' => $joke->category,
            'rating' => $joke->rating,
        ];
    }

    private function getJokeFromDatabase(string $category): Joke
    {
        return Joke::when($category !== 'Any', function ($query) use ($category) {
            return $query->where('category', $category);
        })
            ->inRandomOrder()
            ->firstOrFail();
    }
}
