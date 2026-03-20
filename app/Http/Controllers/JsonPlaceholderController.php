<?php

namespace App\Http\Controllers;

use Faker\Factory;
use Faker\Generator;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class JsonPlaceholderController extends Controller
{
    public function users(Request $request): JsonResponse
    {
        $params = $this->parseCommonParams($request);
        $faker = $this->makeFaker($params['seed']);

        $idBase = ($params['page'] - 1) * $params['count'];
        $items = [];

        for ($i = 0; $i < $params['count']; $i++) {
            $items[] = [
                'id' => $idBase + $i + 1,
                'name' => $faker->name(),
                'username' => $faker->userName(),
                'email' => $faker->safeEmail(),
                'phone' => $faker->phoneNumber(),
                'website' => 'https://'.$faker->domainName(),
                'company' => [
                    'name' => $faker->company(),
                    'catchPhrase' => $faker->catchPhrase(),
                ],
                'address' => [
                    'street' => $faker->streetAddress(),
                    'suite' => $faker->secondaryAddress(),
                    'city' => $faker->city(),
                    'zipcode' => $faker->postcode(),
                    'geo' => [
                        'lat' => (float) $faker->latitude(),
                        'lng' => (float) $faker->longitude(),
                    ],
                ],
            ];
        }

        return $this->jsonResponse($items, $params);
    }

    public function posts(Request $request): JsonResponse
    {
        $params = $this->parseCommonParams($request);
        $faker = $this->makeFaker($params['seed']);

        $idBase = ($params['page'] - 1) * $params['count'];
        $items = [];

        for ($i = 0; $i < $params['count']; $i++) {
            $items[] = [
                'id' => $idBase + $i + 1,
                'userId' => $faker->numberBetween(1, 10),
                'title' => $faker->sentence(),
                'body' => $faker->paragraphs(2, true),
            ];
        }

        return $this->jsonResponse($items, $params);
    }

    public function comments(Request $request): JsonResponse
    {
        $params = $this->parseCommonParams($request);
        $faker = $this->makeFaker($params['seed']);

        $idBase = ($params['page'] - 1) * $params['count'];
        $items = [];

        for ($i = 0; $i < $params['count']; $i++) {
            $items[] = [
                'id' => $idBase + $i + 1,
                'postId' => $faker->numberBetween(1, 100),
                'name' => $faker->sentence(),
                'email' => $faker->safeEmail(),
                'body' => $faker->paragraph(),
            ];
        }

        return $this->jsonResponse($items, $params);
    }

    public function todos(Request $request): JsonResponse
    {
        $params = $this->parseCommonParams($request);
        $faker = $this->makeFaker($params['seed']);

        $idBase = ($params['page'] - 1) * $params['count'];
        $items = [];

        for ($i = 0; $i < $params['count']; $i++) {
            $items[] = [
                'id' => $idBase + $i + 1,
                'userId' => $faker->numberBetween(1, 10),
                'title' => $faker->sentence(),
                'completed' => $faker->boolean(),
            ];
        }

        return $this->jsonResponse($items, $params);
    }

    /**
     * @return array{count: int, page: int, seed: int|null}
     */
    private function parseCommonParams(Request $request): array
    {
        $count = (int) $request->query('count', 10);
        $count = max(1, min(100, $count));

        $page = (int) $request->query('page', 1);
        $page = max(1, $page);

        $seedRaw = $request->query('seed');
        $seed = ($seedRaw !== null && $seedRaw !== '') ? (int) $seedRaw : null;

        return [
            'count' => $count,
            'page' => $page,
            'seed' => $seed,
        ];
    }

    private function makeFaker(?int $seed): Generator
    {
        $faker = Factory::create();
        if ($seed !== null) {
            $faker->seed($seed);
        }

        return $faker;
    }

    /**
     * @param  array<int, mixed>  $data
     * @param  array{count: int, page: int, seed: int|null}  $params
     */
    private function jsonResponse(array $data, array $params): JsonResponse
    {
        $response = response()->json([
            'status' => 'success',
            'count' => $params['count'],
            'data' => $data,
            'meta' => [
                'page' => $params['page'],
                'seed' => $params['seed'],
                'timestamp' => now()->toIso8601String(),
            ],
        ]);

        if ($params['seed'] !== null) {
            $response->header('Cache-Control', 'public, max-age=3600');
        } else {
            $response->header('Cache-Control', 'no-cache, no-store, must-revalidate');
        }

        return $response;
    }
}
