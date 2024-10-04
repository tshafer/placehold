<?php

namespace App\Services;

use Random\Engine\Mt19937;
use Random\Randomizer;

class RandomAnimalService
{
    private const ANIMALS = ['Cat', 'Dog', 'Moose', 'Bear', 'Fox'];

    public function drawRandomAnimal($image, $size, $color, $bgColor, $seed = null)
    {
        $random = $seed ? new Randomizer(new Mt19937(crc32($seed))) : null;

        $selectedAnimal = $this->selectRandomAnimal($random);
        $this->drawAnimal($image, $selectedAnimal, $size, $color, $bgColor, $random);
        $this->addRandomFeatures($image, $size, $color, $bgColor, $random);
    }

    private function selectRandomAnimal($random)
    {
        $animalIndex = $random ? $random->getInt(0, count(self::ANIMALS) - 1) : rand(0, count(self::ANIMALS) - 1);

        return self::ANIMALS[$animalIndex];
    }

    private function drawAnimal($image, $animal, $size, $color, $bgColor, $random)
    {
        $drawMethod = "draw{$animal}";
        $this->$drawMethod($image, $size, $color, $bgColor, $random);
    }

    private function drawCat($image, $size, $color, $bgColor, $random)
    {
        $headSize = $size * 0.7;
        $headCenter = $size / 2;

        // Draw cat head (slightly elongated)
        imagefilledellipse($image, $headCenter, $headCenter, $headSize, $headSize * 0.9, $color);

        // Draw cat ears (more triangular)
        $earSize = $size * 0.25;
        $earOffset = $headSize * 0.35;
        $this->drawTriangularEars($image, $headCenter - $earOffset, $headCenter + $earOffset, $headCenter - $headSize / 2, $earSize, $color);

        // Draw cat eyes (almond-shaped)
        $this->drawAlmondEyes($image, $size, $headCenter, $headSize, $bgColor);

        // Draw cat nose and mouth
        $this->drawCatNoseAndMouth($image, $headCenter, $headCenter + $headSize * 0.1, $size * 0.05, $bgColor);

        // Add whiskers
        $this->drawWhiskers($image, $headCenter, $headCenter + $headSize * 0.1, $size * 0.2, $bgColor);
    }

    private function drawDog($image, $size, $color, $bgColor, $random)
    {
        $headSize = $size * 0.65;
        $headCenter = $size / 2;

        // Draw dog head (slightly elongated snout)
        imagefilledellipse($image, $headCenter, $headCenter, $headSize, $headSize * 0.9, $color);
        $snoutPoints = [
            $headCenter - $headSize * 0.2, $headCenter + $headSize * 0.2,
            $headCenter + $headSize * 0.2, $headCenter + $headSize * 0.2,
            $headCenter, $headCenter + $headSize * 0.4,
        ];
        imagefilledpolygon($image, $snoutPoints, 3, $color);

        // Draw dog ears (more varied shapes)
        $earSize = $size * 0.3;
        $earOffset = $headSize * 0.4;
        $this->drawDogEars($image, $headCenter - $earOffset, $headCenter + $earOffset, $headCenter - $headSize / 2, $earSize, $color, $random);

        // Draw dog eyes
        $this->drawEyes($image, $size, $headCenter, $headSize, $bgColor, 0.25, 0.75, 0.2, 0.07);

        // Draw dog nose
        imagefilledellipse($image, $headCenter, $headCenter + $headSize * 0.25, $size * 0.08, $size * 0.05, $bgColor);
    }

    private function drawMoose($image, $size, $color, $bgColor, $random)
    {
        $headSize = $size * 0.8;
        $headCenter = $size / 2;

        // Draw moose head (more elongated)
        imagefilledellipse($image, $headCenter, $headCenter, $headSize, $headSize * 0.6, $color);

        // Draw moose snout
        $snoutPoints = [
            $headCenter - $headSize * 0.2, $headCenter + $headSize * 0.1,
            $headCenter + $headSize * 0.2, $headCenter + $headSize * 0.1,
            $headCenter, $headCenter + $headSize * 0.3,
        ];
        imagefilledpolygon($image, $snoutPoints, 3, $color);

        // Draw moose antlers (more detailed)
        $antlerSize = $size * 0.5;
        $antlerOffset = $headSize * 0.3;
        $this->drawDetailedMooseAntlers($image, $headCenter - $antlerOffset, $headCenter + $antlerOffset, $headCenter - $headSize / 2, $antlerSize, $color);

        // Draw moose eyes
        $this->drawEyes($image, $size, $headCenter, $headSize, $bgColor, 0.25, 0.75, 0.2, 0.05);

        // Draw moose nostrils
        $nostrilSize = $size * 0.03;
        imagefilledellipse($image, $headCenter - $nostrilSize * 2, $headCenter + $headSize * 0.2, $nostrilSize, $nostrilSize, $bgColor);
        imagefilledellipse($image, $headCenter + $nostrilSize * 2, $headCenter + $headSize * 0.2, $nostrilSize, $nostrilSize, $bgColor);
    }

    private function drawBear($image, $size, $color, $bgColor, $random)
    {
        $headSize = $size * 0.8;
        $headCenter = $size / 2;

        // Draw bear head (more rounded)
        imagefilledellipse($image, $headCenter, $headCenter, $headSize, $headSize * 0.9, $color);

        // Draw bear snout
        $snoutSize = $size * 0.3;
        imagefilledellipse($image, $headCenter, $headCenter + $headSize * 0.2, $snoutSize, $snoutSize * 0.7, $color);

        // Draw bear ears (smaller and rounder)
        $earSize = $size * 0.15;
        $earOffset = $headSize * 0.35;
        $this->drawRoundedEars($image, $headCenter - $earOffset, $headCenter + $earOffset, $headCenter - $headSize / 2, $earSize, $color);

        // Draw bear eyes (smaller)
        $this->drawEyes($image, $size, $headCenter, $headSize, $bgColor, 0.25, 0.75, 0.1, 0.05);

        // Draw bear nose
        imagefilledellipse($image, $headCenter, $headCenter + $headSize * 0.25, $size * 0.08, $size * 0.05, $bgColor);
    }

    private function drawFox($image, $size, $color, $bgColor, $random)
    {
        $headSize = $size * 0.7;
        $headCenter = $size / 2;

        // Draw fox head (more triangular)
        $headPoints = [
            $headCenter - $headSize / 2, $headCenter + $headSize * 0.3,
            $headCenter + $headSize / 2, $headCenter + $headSize * 0.3,
            $headCenter, $headCenter - $headSize * 0.4,
        ];
        imagefilledpolygon($image, $headPoints, 3, $color);

        // Draw fox ears (larger and more pointed)
        $earSize = $size * 0.3;
        $earOffset = $headSize * 0.25;
        $this->drawTriangularEars($image, $headCenter - $earOffset, $headCenter + $earOffset, $headCenter - $headSize / 2 - $earSize / 2, $earSize, $color);

        // Draw fox eyes (slightly slanted)
        $this->drawSlantedEyes($image, $size, $headCenter, $headSize, $bgColor);

        // Draw fox snout
        $snoutSize = $size * 0.15;
        imagefilledellipse($image, $headCenter, $headCenter + $headSize * 0.1, $snoutSize, $snoutSize * 0.6, $color);

        // Draw fox nose
        imagefilledellipse($image, $headCenter, $headCenter + $headSize * 0.2, $size * 0.04, $size * 0.02, $bgColor);
    }

    private function drawAlmondEyes($image, $size, $headCenter, $headSize, $bgColor)
    {
        $eyeSize = $size * 0.1;
        $eyeY = $headCenter - $headSize * 0.05;
        $leftEyeX = $headCenter - $headSize * 0.25;
        $rightEyeX = $headCenter + $headSize * 0.25;

        $this->drawAlmondShape($image, $leftEyeX, $eyeY, $eyeSize, $eyeSize * 0.6, $bgColor);
        $this->drawAlmondShape($image, $rightEyeX, $eyeY, $eyeSize, $eyeSize * 0.6, $bgColor);
    }

    private function drawAlmondShape($image, $centerX, $centerY, $width, $height, $color)
    {
        $points = [];
        for ($i = 0; $i < 360; $i += 10) {
            $x = $centerX + $width / 2 * cos(deg2rad($i));
            $y = $centerY + $height / 2 * sin(deg2rad($i));
            $points[] = $x;
            $points[] = $y;
        }
        imagefilledpolygon($image, $points, count($points) / 2, $color);
    }

    private function drawCatNoseAndMouth($image, $centerX, $centerY, $size, $color)
    {
        // Draw triangular nose
        $nosePoints = [
            $centerX - $size / 2, $centerY,
            $centerX + $size / 2, $centerY,
            $centerX, $centerY + $size / 2,
        ];
        imagefilledpolygon($image, $nosePoints, 3, $color);

        // Draw mouth
        imageline($image, $centerX, $centerY + $size / 2, $centerX, $centerY + $size, $color);
        imagearc($image, $centerX - $size / 4, $centerY + $size, $size / 2, $size / 4, 0, 180, $color);
        imagearc($image, $centerX + $size / 4, $centerY + $size, $size / 2, $size / 4, 0, 180, $color);
    }

    private function drawWhiskers($image, $centerX, $centerY, $length, $color)
    {
        for ($i = -1; $i <= 1; $i++) {
            imageline($image, $centerX - $length / 2, $centerY + $i * 5, $centerX - $length, $centerY + $i * 10, $color);
            imageline($image, $centerX + $length / 2, $centerY + $i * 5, $centerX + $length, $centerY + $i * 10, $color);
        }
    }

    private function drawDogEars($image, $leftEarX, $rightEarX, $earY, $earSize, $color, $random)
    {
        $earType = $random ? $random->getInt(0, 2) : rand(0, 2);

        switch ($earType) {
            case 0: // Floppy ears
                $this->drawFloppyEars($image, $leftEarX, $rightEarX, $earY, $earSize, $color);
                break;
            case 1: // Pointed ears
                $this->drawTriangularEars($image, $leftEarX, $rightEarX, $earY, $earSize, $color);
                break;
            case 2: // Round ears
                $this->drawRoundedEars($image, $leftEarX, $rightEarX, $earY, $earSize, $color);
                break;
        }
    }

    private function drawFloppyEars($image, $leftEarX, $rightEarX, $earY, $earSize, $color)
    {
        $points = [
            $leftEarX, $earY,
            $leftEarX - $earSize, $earY + $earSize * 1.5,
            $leftEarX + $earSize * 0.5, $earY + $earSize,
        ];
        imagefilledpolygon($image, $points, 3, $color);

        $points = [
            $rightEarX, $earY,
            $rightEarX + $earSize, $earY + $earSize * 1.5,
            $rightEarX - $earSize * 0.5, $earY + $earSize,
        ];
        imagefilledpolygon($image, $points, 3, $color);
    }

    private function drawTriangularEars($image, $leftEarX, $rightEarX, $earY, $earSize, $color)
    {
        $points = [
            $leftEarX, $earY + $earSize,
            $leftEarX - $earSize / 2, $earY,
            $leftEarX + $earSize / 2, $earY,
        ];
        imagefilledpolygon($image, $points, 3, $color);

        $points = [
            $rightEarX, $earY + $earSize,
            $rightEarX - $earSize / 2, $earY,
            $rightEarX + $earSize / 2, $earY,
        ];
        imagefilledpolygon($image, $points, 3, $color);
    }

    private function drawDetailedMooseAntlers($image, $leftAntlerX, $rightAntlerX, $antlerY, $antlerSize, $color)
    {
        // Main antler branch
        imageline($image, $leftAntlerX, $antlerY, $leftAntlerX - $antlerSize * 0.5, $antlerY - $antlerSize, $color);
        imageline($image, $rightAntlerX, $antlerY, $rightAntlerX + $antlerSize * 0.5, $antlerY - $antlerSize, $color);

        // Secondary branches
        for ($i = 1; $i <= 3; $i++) {
            $branchY = $antlerY - $antlerSize * $i / 4;
            imageline($image, $leftAntlerX - $antlerSize * 0.25 * $i, $branchY, $leftAntlerX - $antlerSize * 0.5 * $i, $branchY - $antlerSize * 0.25, $color);
            imageline($image, $rightAntlerX + $antlerSize * 0.25 * $i, $branchY, $rightAntlerX + $antlerSize * 0.5 * $i, $branchY - $antlerSize * 0.25, $color);
        }
    }

    private function drawSlantedEyes($image, $size, $headCenter, $headSize, $bgColor)
    {
        $eyeSize = $size * 0.08;
        $eyeY = $headCenter - $headSize * 0.1;
        $leftEyeX = $headCenter - $headSize * 0.25;
        $rightEyeX = $headCenter + $headSize * 0.25;

        $this->drawSlantedEllipse($image, $leftEyeX, $eyeY, $eyeSize, $eyeSize * 0.5, -20, $bgColor);
        $this->drawSlantedEllipse($image, $rightEyeX, $eyeY, $eyeSize, $eyeSize * 0.5, 20, $bgColor);
    }

    private function drawSlantedEllipse($image, $centerX, $centerY, $width, $height, $angle, $color)
    {
        $points = [];
        for ($i = 0; $i < 360; $i += 10) {
            $x = $width / 2 * cos(deg2rad($i));
            $y = $height / 2 * sin(deg2rad($i));
            $rotatedX = $x * cos(deg2rad($angle)) - $y * sin(deg2rad($angle));
            $rotatedY = $x * sin(deg2rad($angle)) + $y * cos(deg2rad($angle));
            $points[] = $centerX + $rotatedX;
            $points[] = $centerY + $rotatedY;
        }
        imagefilledpolygon($image, $points, count($points) / 2, $color);
    }

    private function addRandomFeatures($image, $size, $color, $bgColor, $random)
    {
        if ($this->randomBool($random)) {
            $this->addRealisticSpots($image, $size, $bgColor, $random);
        }

        if ($this->randomBool($random)) {
            $this->addRealisticStripes($image, $size, $bgColor, $random);
        }

        if ($this->randomBool($random)) {
            $this->addFurTexture($image, $size, $color, $bgColor, $random);
        }
    }

    private function addRealisticSpots($image, $size, $bgColor, $random)
    {
        $spotCount = $random ? $random->getInt(3, 10) : rand(3, 10);
        for ($i = 0; $i < $spotCount; $i++) {
            $spotX = $this->randomInt(0, $size, $random);
            $spotY = $this->randomInt(0, $size, $random);
            $spotSize = $this->randomInt($size * 0.05, $size * 0.15, $random);
            $this->drawIrregularSpot($image, $spotX, $spotY, $spotSize, $bgColor);
        }
    }

    private function drawIrregularSpot($image, $centerX, $centerY, $size, $color)
    {
        $points = [];
        $numPoints = 8;
        for ($i = 0; $i < $numPoints; $i++) {
            $angle = 2 * M_PI * $i / $numPoints;
            $radius = $size * (0.8 + 0.4 * (mt_rand() / mt_getrandmax()));
            $x = $centerX + $radius * cos($angle);
            $y = $centerY + $radius * sin($angle);
            $points[] = $x;
            $points[] = $y;
        }
        imagefilledpolygon($image, $points, $numPoints, $color);
    }

    private function addRealisticStripes($image, $size, $bgColor, $random)
    {
        $stripeCount = $this->randomInt(3, 7, $random);
        for ($i = 0; $i < $stripeCount; $i++) {
            $startY = $this->randomInt(0, $size, $random);
            $endY = $this->randomInt(0, $size, $random);
            $width = $this->randomInt($size * 0.02, $size * 0.05, $random);
            $this->drawCurvedStripe($image, 0, $startY, $size, $endY, $width, $bgColor);
        }
    }

    private function drawCurvedStripe($image, $x1, $y1, $x2, $y2, $width, $color)
    {
        $controlX = ($x1 + $x2) / 2;
        $controlY = ($y1 + $y2) / 2 + $this->randomInt(-$width * 2, $width * 2, null);

        for ($t = 0; $t <= 1; $t += 0.01) {
            $x = (1 - $t) * (1 - $t) * $x1 + 2 * (1 - $t) * $t * $controlX + $t * $t * $x2;
            $y = (1 - $t) * (1 - $t) * $y1 + 2 * (1 - $t) * $t * $controlY + $t * $t * $y2;
            imagefilledellipse($image, $x, $y, $width, $width, $color);
        }
    }

    private function addFurTexture($image, $size, $color, $bgColor, $random)
    {
        $furDensity = $this->randomInt(1000, 3000, $random);
        for ($i = 0; $i < $furDensity; $i++) {
            $x = $this->randomInt(0, $size, $random);
            $y = $this->randomInt(0, $size, $random);
            $length = $this->randomInt(1, 3, $random);
            $angle = $this->randomInt(0, 360, $random);
            $endX = $x + $length * cos(deg2rad($angle));
            $endY = $y + $length * sin(deg2rad($angle));
            $furColor = $this->randomBool($random) ? $color : $bgColor;
            imageline($image, $x, $y, $endX, $endY, $furColor);
        }
    }

    private function randomBool($random)
    {
        return $random ? $random->getInt(0, 1) : (bool) rand(0, 1);
    }

    private function randomInt($min, $max, $random)
    {
        return $random ? $random->getInt($min, $max) : rand($min, $max);
    }

    private function drawEyes($image, $size, $headCenter, $headSize, $bgColor, $leftXRatio, $rightXRatio, $yRatio, $eyeSizeRatio)
    {
        $eyeSize = $size * $eyeSizeRatio;
        $eyeY = $headCenter - $headSize * $yRatio;
        $leftEyeX = $headCenter - $headSize * $leftXRatio;
        $rightEyeX = $headCenter + $headSize * $rightXRatio;

        imagefilledellipse($image, $leftEyeX, $eyeY, $eyeSize, $eyeSize, $bgColor);
        imagefilledellipse($image, $rightEyeX, $eyeY, $eyeSize, $eyeSize, $bgColor);
    }

    private function drawRoundedEars($image, $leftEarX, $rightEarX, $earY, $earSize, $color)
    {
        // Draw left ear
        imagefilledellipse($image, $leftEarX, $earY, $earSize, $earSize, $color);

        // Draw right ear
        imagefilledellipse($image, $rightEarX, $earY, $earSize, $earSize, $color);
    }
}
