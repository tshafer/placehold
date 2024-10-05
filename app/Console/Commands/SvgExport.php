<?php

namespace App\Console\Commands;

use DOMDocument;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SvgExport extends Command
{
    protected $signature = 'svg:export {input : Path to the input HTML file} {output : Path to the output directory}';

    protected $description = 'Export SVG elements from an HTML file to individual SVG files';

    public function handle()
    {
        $inputFile = $this->argument('input');
        $outputDir = $this->argument('output');

        $removeMetadata = function ($svgContent) {
            $svgContent = preg_replace('/<metadata>.*?<\/metadata>/s', '', $svgContent);
            $svgContent = preg_replace('/<metadata><rdf:RDF.*?<\/rdf:RDF><\/metadata>/s', '', $svgContent);

            return $svgContent;
        };

        $existingSvgFiles = File::glob($outputDir.'/*.svg');
        foreach ($existingSvgFiles as $svgFile) {
            $svgContent = File::get($svgFile);
            $cleanedSvgContent = $removeMetadata($svgContent);
            File::put($svgFile, $cleanedSvgContent);
        }

        $this->info('Metadata removed from existing SVG files.');
        if (! File::exists($inputFile)) {
            $this->error("Input file does not exist: $inputFile");

            return 1;
        }

        if (! File::isDirectory($outputDir)) {
            File::makeDirectory($outputDir, 0755, true);
        }

        $dom = new DOMDocument;
        @$dom->loadHTML(File::get($inputFile));

        $count = 0;
        $existingNames = [];
        $svgContentMap = [];

        foreach ($dom->getElementsByTagName('div') as $div) {
            if ($div->getAttribute('class') && strpos($div->getAttribute('class'), 'bg-black/30') !== false) {
                $svg = $div->getElementsByTagName('svg')->item(0);
                if ($svg) {
                    $svgContent = $dom->saveXML($svg);
                    $svgContent = preg_replace('/([a-zA-Z-]+)=([^"\s]+)/', '$1="$2"', $svgContent);
                    $svgContent = $removeMetadata($svgContent);

                    $spanElement = $div->nextSibling;
                    while ($spanElement && $spanElement->nodeType != XML_ELEMENT_NODE) {
                        $spanElement = $spanElement->nextSibling;
                    }
                    $iconName = ($spanElement && $spanElement->nodeName == 'span') ?
                        trim($spanElement->textContent) :
                        'Default Icon';

                    $baseIconName = $iconName;
                    $suffix = 1;
                    while (in_array(strtolower($iconName), $existingNames)) {
                        $iconName = $baseIconName.' '.$suffix;
                        $suffix++;
                    }
                    $existingNames[] = strtolower($iconName);

                    $filename = strtolower(str_replace(' ', '_', $iconName)).'.svg';

                    if (! in_array($svgContent, $svgContentMap)) {
                        $svgContentMap[$filename] = $svgContent;
                    }
                }
            }
        }

        foreach ($svgContentMap as $filename => $svgContent) {
            $outputPath = $outputDir.'/'.$filename;
            if (! File::exists($outputPath)) {
                File::put($outputPath, $svgContent);
                $this->info("Exported: $outputPath");
                $count++;
            } else {
                File::delete($outputPath);
                File::put($outputPath, $svgContent);
                $this->info("Updated: $outputPath");
                $count++;
            }
        }

        $resourceSvgDir = resource_path('svg');
        $publicSvgDir = public_path('svg');

        if (! File::isDirectory($publicSvgDir)) {
            File::makeDirectory($publicSvgDir, 0755, true);
        }

        $resourceFiles = File::files($resourceSvgDir);
        $publicFiles = File::files($publicSvgDir);

        foreach ($publicFiles as $publicFile) {
            $filename = $publicFile->getFilename();
            if (! File::exists($resourceSvgDir.'/'.$filename)) {
                File::delete($publicFile);
                $this->info("Removed from public/svg: $filename");
            }
        }

        $processedContents = [];
        foreach ($resourceFiles as $file) {
            $filename = $file->getFilename();
            $destinationPath = $publicSvgDir.'/'.$filename;

            $svgContent = File::get($file->getPathname());
            $svgContent = preg_replace('/([a-zA-Z-]+)=([^"\s]+)/', '$1="$2"', $svgContent);
            $svgContent = $removeMetadata($svgContent);

            if (! in_array($svgContent, $processedContents)) {
                File::put($destinationPath, $svgContent);
                $this->info("Synced and fixed: $destinationPath");
                $count++;
                $processedContents[] = $svgContent;
            } else {
                $this->info("Duplicate content, skipping: $filename");
            }
        }

        $this->info("Export and sync completed. Total unique SVGs processed: $count");

        return 0;
    }
}
