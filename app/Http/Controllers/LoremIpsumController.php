<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LoremIpsumController extends Controller
{
    private $words = [
        'lorem', 'ipsum', 'dolor', 'sit', 'amet', 'consectetur', 'adipiscing', 'elit',
        'sed', 'do', 'eiusmod', 'tempor', 'incididunt', 'ut', 'labore', 'et', 'dolore',
        'magna', 'aliqua', 'enim', 'ad', 'minim', 'veniam', 'quis', 'nostrud',
        'exercitation', 'ullamco', 'laboris', 'nisi', 'aliquip', 'ex', 'ea',
        'commodo', 'consequat', 'duis', 'aute', 'irure', 'in', 'reprehenderit',
        'voluptate', 'velit', 'esse', 'cillum', 'eu', 'fugiat', 'nulla',
        'pariatur', 'excepteur', 'sint', 'occaecat', 'cupidatat', 'non', 'proident',
        'sunt', 'culpa', 'qui', 'officia', 'deserunt', 'mollit', 'anim', 'id',
        'est', 'laborum', 'perspiciatis', 'unde', 'omnis', 'iste', 'natus',
        'error', 'voluptatem', 'accusantium', 'doloremque', 'laudantium',
        'totam', 'rem', 'aperiam', 'eaque', 'ipsa', 'quae', 'ab', 'illo', 'inventore',
        'veritatis', 'quasi', 'architecto', 'beatae', 'vitae', 'dicta',
        'explicabo', 'nemo', 'ipsam', 'quia', 'voluptas',
        'aspernatur', 'odit', 'fugit', 'consequuntur',
        'magni', 'dolores', 'eos', 'ratione', 'sequi', 'nesciunt',
        'neque', 'porro', 'quisquam', 'adipisci',
        'numquam', 'eius', 'modi', 'tempora', 'incidunt',
        'magnam', 'aliquam', 'quaerat', 'minima',
        'nostrum', 'exercitationem', 'ullam', 'corporis', 'suscipit',
        'laboriosam', 'aliquid', 'commodi',
        'autem', 'vel', 'eum', 'iure',
        'quam', 'nihil', 'molestiae',
        'illum', 'quo',
        'at', 'vero', 'accusamus', 'iusto', 'odio',
        'dignissimos', 'ducimus', 'blanditiis', 'praesentium', 'voluptatum',
        'deleniti', 'atque', 'corrupti', 'quos', 'quas', 'molestias',
        'excepturi', 'occaecati', 'cupiditate', 'provident', 'similique',
        'mollitia', 'animi',
        'dolorum', 'fuga', 'harum', 'quidem', 'rerum',
        'facilis', 'expedita', 'distinctio', 'nam', 'libero',

    ];

    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $paragraphs = $request->input('paragraphs', 3);
        $minWords = $request->input('minWords', 5);
        $maxWords = $request->input('maxWords', 20);
        $startWithLoremIpsum = $request->input('startWithLoremIpsum', true);
        $useCache = $request->input('useCache', false);
        $format = $request->input('format', 'json');
        $capitalize = $request->input('capitalize', true);
        $addPunctuation = $request->input('addPunctuation', false);
        $seed = $request->input('seed');
        $uniqueWords = $request->input('uniqueWords', false);

        try {
            $this->validateInput($paragraphs, $minWords, $maxWords);

            $cacheKey = $this->generateCacheKey($paragraphs, $minWords, $maxWords, $startWithLoremIpsum, $format, $capitalize, $addPunctuation, $seed, $uniqueWords);

            if ($useCache && Cache::has($cacheKey)) {
                return response()->json([
                    'status' => 'success',
                    'data' => Cache::get($cacheKey),
                    'source' => 'cache',
                ]);
            }

            if ($seed !== null) {
                mt_srand((int) $seed);
            } else {
                mt_srand();
            }

            $result = [];

            for ($i = 0; $i < $paragraphs; $i++) {
                $wordCount = mt_rand($minWords, $maxWords);
                $paragraph = $this->generateParagraph($wordCount, $i === 0 && $startWithLoremIpsum, $capitalize, $addPunctuation, $uniqueWords);
                $result[] = $paragraph;
            }

            $formattedResult = $this->formatResult($result, $format);

            if ($useCache) {
                Cache::put($cacheKey, $formattedResult, now()->addHours(24));
            }

            return response()->json([
                'status' => 'success',
                'data' => $formattedResult,
                'metadata' => [
                    'paragraphs' => $paragraphs,
                    'minWords' => $minWords,
                    'maxWords' => $maxWords,
                    'totalWords' => array_sum(array_map('str_word_count', $result)),
                    'format' => $format,
                    'seed' => $seed ?? mt_rand(),
                ],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred: '.$e->getMessage(),
            ], 500);
        }
    }

    private function validateInput(int $paragraphs, int $minWords, int $maxWords): void
    {
        if ($paragraphs < 1 || $paragraphs > 100) {
            throw new \InvalidArgumentException('Number of paragraphs must be between 1 and 100.');
        }

        if ($minWords < 1 || $minWords > 100) {
            throw new \InvalidArgumentException('Minimum words must be between 1 and 100.');
        }

        if ($maxWords < $minWords || $maxWords > 100) {
            throw new \InvalidArgumentException('Maximum words must be between minWords and 100.');
        }
    }

    private function generateCacheKey(int $paragraphs, int $minWords, int $maxWords, bool $startWithLoremIpsum, string $format, bool $capitalize, bool $addPunctuation, ?int $seed, bool $uniqueWords): string
    {
        return md5(implode('|', [$paragraphs, $minWords, $maxWords, $startWithLoremIpsum, $format, $capitalize, $addPunctuation, $seed, $uniqueWords]));
    }

    private function generateParagraph(int $wordCount, bool $startWithLoremIpsum, bool $capitalize, bool $addPunctuation, bool $uniqueWords): string
    {
        $paragraph = [];
        $usedWords = [];

        if ($startWithLoremIpsum) {
            $paragraph[] = 'Lorem';
            $paragraph[] = 'ipsum';
            $wordCount -= 2;
        }

        while (count($paragraph) < $wordCount) {
            $word = $this->words[array_rand($this->words)];
            if (! $uniqueWords || ! in_array($word, $usedWords)) {
                $paragraph[] = $word;
                $usedWords[] = $word;
            }
        }

        if ($capitalize) {
            $paragraph = array_map('ucfirst', $paragraph);
        }

        $result = implode(' ', $paragraph);

        if ($addPunctuation) {
            $result .= '.';
        }

        return $result;
    }

    private function formatResult(array $paragraphs, string $format): string|array
    {
        switch ($format) {
            case 'html':
                return '<p>'.implode('</p><p>', $paragraphs).'</p>';
            case 'text':
                return implode("\n\n", $paragraphs);
            case 'json':
            default:
                return $paragraphs;
        }
    }
}
