<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IconsController extends Controller
{
    public function downloadAllIcons(Request $request)
    {
        $zipFileName = 'all_icons.zip';
        $zipFilePath = storage_path('app/public/'.$zipFileName);

        $zip = new \ZipArchive;
        if ($zip->open($zipFilePath, \ZipArchive::CREATE | \ZipArchive::OVERWRITE) === true) {
            $svgFiles = glob(resource_path('svg/*.svg'));

            foreach ($svgFiles as $file) {
                $zip->addFile($file, basename($file));
            }

            $zip->close();
        }

        return Storage::disk('public')->download($zipFileName, $zipFileName, [
            'Content-Type' => 'application/zip',
            'Content-Disposition' => 'attachment; filename='.$zipFileName,
        ]);
    }
}
