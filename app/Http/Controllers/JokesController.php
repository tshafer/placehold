<?php

namespace App\Http\Controllers;

use App\Services\JokeService;
use Illuminate\Http\Request;

class JokesController extends Controller
{
    private $jokeService;

    public function __construct(JokeService $jokeService)
    {
        $this->jokeService = $jokeService;
    }

    public function __invoke(Request $request)
    {

        $category = $request->input('category', 'Any');
        $lang = $request->input('lang', 'en');

        return $this->jokeService->getRandomJoke($category);
    }
}
