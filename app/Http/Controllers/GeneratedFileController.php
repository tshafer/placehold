<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GeneratedFileController extends Controller
{
    public function video(string $id): Response
    {
        return $this->serve('video', $id, 'mp4', 'video/mp4');
    }

    public function pdf(string $id): Response
    {
        return $this->serve('pdf', $id, 'pdf', 'application/pdf');
    }

    private function serve(string $type, string $id, string $ext, string $mime): Response
    {
        $path = storage_path('app/generated/' . $id . '.' . $ext);

        if (! preg_match('/^[a-f0-9\-]{36}$/i', $id) || ! file_exists($path)) {
            abort(404);
        }

        $filename = $type === 'video' ? 'placeholder.mp4' : 'placeholder.pdf';

        return response()->file($path, [
            'Content-Type' => $mime,
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ])->deleteFileAfterSend(true);
    }
}
