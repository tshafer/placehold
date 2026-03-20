<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UuidController extends Controller
{
    public function __invoke(Request $request)
    {
        $count = clamp((int) $request->query('count', 1), 1, 100);
        $version = (int) $request->query('version', 4);
        $uppercase = filter_var($request->query('uppercase', 'false'), FILTER_VALIDATE_BOOLEAN);
        $nodashes = filter_var($request->query('nodashes', 'false'), FILTER_VALIDATE_BOOLEAN);

        $uuids = [];

        for ($i = 0; $i < $count; $i++) {
            $uuid = match ($version) {
                7 => (string) Str::orderedUuid(),
                default => (string) Str::uuid(),
            };

            if ($nodashes) {
                $uuid = str_replace('-', '', $uuid);
            }

            if ($uppercase) {
                $uuid = strtoupper($uuid);
            }

            $uuids[] = $uuid;
        }

        $response = [
            'count' => $count,
            'version' => $version === 7 ? 7 : 4,
            'uuids' => $uuids,
        ];

        if ($count === 1) {
            $response['uuid'] = $uuids[0];
        }

        return response()->json($response);
    }
}

function clamp(int $value, int $min, int $max): int
{
    return max($min, min($max, $value));
}
