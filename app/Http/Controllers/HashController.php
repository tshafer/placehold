<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HashController extends Controller
{
    private const ALGORITHMS = [
        'md5', 'sha1', 'sha224', 'sha256', 'sha384', 'sha512',
        'crc32', 'crc32b', 'adler32', 'fnv132', 'fnv1a32',
        'fnv164', 'fnv1a64', 'xxh32', 'xxh64', 'xxh128',
    ];

    public function __invoke(Request $request)
    {
        $data = $request->query('data');

        if ($data === null || $data === '') {
            return response()->json([
                'error' => 'The data parameter is required',
                'available_algorithms' => self::ALGORITHMS,
            ], 422);
        }

        $algo = strtolower($request->query('algo', 'sha256'));

        if (! in_array($algo, hash_algos())) {
            return response()->json([
                'error' => "Unknown algorithm: {$algo}",
                'available_algorithms' => self::ALGORITHMS,
            ], 422);
        }

        $all = filter_var($request->query('all', 'false'), FILTER_VALIDATE_BOOLEAN);

        if ($all) {
            $hashes = [];
            foreach (self::ALGORITHMS as $a) {
                $hashes[$a] = hash($a, $data);
            }

            return response()->json([
                'data' => $data,
                'hashes' => $hashes,
            ])->header('Cache-Control', 'public, max-age=86400');
        }

        return response()->json([
            'data' => $data,
            'algorithm' => $algo,
            'hash' => hash($algo, $data),
            'length' => strlen(hash($algo, $data)),
        ])->header('Cache-Control', 'public, max-age=86400');
    }
}
