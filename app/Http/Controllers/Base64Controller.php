<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Base64Controller extends Controller
{
    public function __invoke(Request $request)
    {
        $encode = $request->query('encode');
        $decode = $request->query('decode');

        if ($encode === null && $decode === null) {
            return response()->json([
                'error' => 'Provide either ?encode= or ?decode= parameter',
            ], 422);
        }

        if ($encode !== null) {
            return response()->json([
                'input' => $encode,
                'output' => base64_encode($encode),
                'operation' => 'encode',
                'length' => strlen(base64_encode($encode)),
            ])->header('Cache-Control', 'public, max-age=86400');
        }

        $decoded = base64_decode($decode, true);

        if ($decoded === false) {
            return response()->json([
                'error' => 'Invalid base64 input',
                'input' => $decode,
            ], 422);
        }

        return response()->json([
            'input' => $decode,
            'output' => $decoded,
            'operation' => 'decode',
            'length' => strlen($decoded),
        ])->header('Cache-Control', 'public, max-age=86400');
    }
}
