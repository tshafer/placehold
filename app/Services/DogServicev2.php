<?php

namespace App\Services;

use SVG\Nodes\Shapes\SVGPath;
use SVG\Nodes\Structures\SVGGroup;
use SVG\SVG;

class DogServicev2
{
    public function drawDog($size, $color, $bgColor, $seed)
    {
        // Use seed to generate consistent random choices
        $random = $seed ? (new \Random\Randomizer(new \Random\Engine\Mt19937(crc32($seed)))) : null;

        // Create SVG document
        $svg = new SVG($size, $size);
        $doc = $svg->getDocument();

        // Create a group for the dog
        $dogGroup = new SVGGroup;
        $doc->addChild($dogGroup);

        // Draw dog body
        $bodyPath = new SVGPath('M50,70 Q60,60 70,70 Q80,80 90,70 Q100,60 110,70 Q120,80 130,70 V120 Q90,140 50,120 Z');
        $bodyPath->setStyle('fill', $color);
        $dogGroup->addChild($bodyPath);

        // Draw dog head
        $headPath = new SVGPath('M70,50 Q90,30 110,50 Q130,70 110,90 Q90,110 70,90 Q50,70 70,50 Z');
        $headPath->setStyle('fill', $color);
        $dogGroup->addChild($headPath);

        // Draw dog ears
        $leftEarPath = new SVGPath('M70,60 Q60,40 50,60 Q60,70 70,60 Z');
        $leftEarPath->setStyle('fill', $color);
        $dogGroup->addChild($leftEarPath);

        $rightEarPath = new SVGPath('M110,60 Q120,40 130,60 Q120,70 110,60 Z');
        $rightEarPath->setStyle('fill', $color);
        $dogGroup->addChild($rightEarPath);

        // Draw dog eyes
        $leftEyePath = new SVGPath('M80,70 A5,5 0 1,1 80,69 Z');
        $leftEyePath->setStyle('fill', $bgColor);
        $dogGroup->addChild($leftEyePath);

        $rightEyePath = new SVGPath('M100,70 A5,5 0 1,1 100,69 Z');
        $rightEyePath->setStyle('fill', $bgColor);
        $dogGroup->addChild($rightEyePath);

        // Draw dog nose
        $nosePath = new SVGPath('M90,80 Q95,85 90,90 Q85,85 90,80 Z');
        $nosePath->setStyle('fill', $bgColor);
        $dogGroup->addChild($nosePath);

        // Draw dog mouth
        $mouthPath = new SVGPath('M85,95 Q90,100 95,95');
        $mouthPath->setStyle('fill', 'none')
            ->setStyle('stroke', $bgColor)
            ->setStyle('stroke-width', '2');
        $dogGroup->addChild($mouthPath);

        // Draw dog legs
        $frontLegPath = new SVGPath('M60,120 V150 Q65,155 70,150 V120');
        $frontLegPath->setStyle('fill', $color);
        $dogGroup->addChild($frontLegPath);

        $backLegPath = new SVGPath('M110,120 V150 Q115,155 120,150 V120');
        $backLegPath->setStyle('fill', $color);
        $dogGroup->addChild($backLegPath);

        // Draw dog tail
        $tailPath = new SVGPath('M130,100 Q150,90 140,70');
        $tailPath->setStyle('fill', 'none')
            ->setStyle('stroke', $color)
            ->setStyle('stroke-width', '10')
            ->setStyle('stroke-linecap', 'round');
        $dogGroup->addChild($tailPath);

        return $svg;
    }
}
