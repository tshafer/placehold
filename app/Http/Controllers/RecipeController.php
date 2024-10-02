<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class RecipeController extends Controller
{
    private const API_BASE_URL = 'https://www.themealdb.com/api/json/v1/1/';

    private const DEFAULT_NUMBER = 10;

    public function __invoke(Request $request)
    {
        $validated = $this->validateRequest($request);

        if ($validated instanceof \Illuminate\Http\JsonResponse) {
            return $validated;
        }

        return $this->fetchRecipe($validated);
    }

    private function validateRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'query' => 'nullable|string|max:255',
            'category' => 'nullable|string',
            'area' => 'nullable|string',
            'number' => 'integer|min:1|max:25',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()], 400);
        }

        return $validator->validated();
    }

    private function fetchRecipe(array $params)
    {
        try {
            $endpoint = 'random.php';
            $recipes = [];

            for ($i = 0; $i < ($params['number'] ?? self::DEFAULT_NUMBER); $i++) {
                $response = Http::get(self::API_BASE_URL.$endpoint);

                if (! $response->successful()) {
                    Log::error('Recipe API Error', ['response' => $response->body()]);

                    return response()->json(['status' => 'error', 'message' => 'Unable to fetch recipes'], 500);
                }

                $data = $response->json();
                $meal = $data['meals'][0];

                $recipes[] = [
                    'id' => $meal['idMeal'],
                    'title' => $meal['strMeal'],
                    'image' => $meal['strMealThumb'],
                    'category' => $meal['strCategory'],
                    'area' => $meal['strArea'],
                    'instructions' => $meal['strInstructions'],
                    'sourceUrl' => $meal['strSource'],
                    'youtubeUrl' => $meal['strYoutube'],
                    'ingredients' => $this->getIngredients($meal),
                ];
            }

            return response()->json([
                'status' => 'success',
                'data' => $recipes,
                'timestamp' => now()->toDateTimeString(),
            ]);
        } catch (\Exception $e) {
            Log::error('Recipe API Exception', ['error' => $e->getMessage()]);

            return response()->json(['status' => 'error', 'message' => 'An error occurred while fetching recipes'], 500);
        }
    }

    private function getIngredients($meal)
    {
        $ingredients = [];
        for ($i = 1; $i <= 20; $i++) {
            $ingredient = $meal["strIngredient$i"];
            $measure = $meal["strMeasure$i"];
            if ($ingredient && trim($ingredient) !== '') {
                $ingredients[] = [
                    'ingredient' => $ingredient,
                    'measure' => $measure,
                ];
            }
        }

        return $ingredients;
    }
}
