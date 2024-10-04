<?php

namespace App\Services;

class DogService
{
    public function drawDog($image, $size, $color, $bgColor, $seed)
    {
        // Use seed to generate consistent random choices
        $random = $seed ? (new \Random\Randomizer(new \Random\Engine\Mt19937(crc32($seed)))) : null;

        // Calculate sizes based on the overall image size
        $headSize = $size * 0.7;
        $headX = ($size - $headSize) / 2;
        $headY = ($size - $headSize) / 2;
        $earSize = $size * 0.25;
        $leftEarX = $headX + $headSize * 0.15;
        $rightEarX = $headX + $headSize * 0.85;
        $earY = $headY - $earSize * 0.5;
        $eyeSize = $size * 0.06;
        $eyeY = $headY + $headSize * 0.35;
        $leftEyeX = $headX + $headSize * 0.3;
        $rightEyeX = $headX + $headSize * 0.7;
        $noseSize = $size * 0.06;
        $noseX = $headX + $headSize / 2;
        $noseY = $headY + $headSize * 0.6;
        $mouthY = $noseY + $noseSize * 0.8;
        $mouthWidth = $headSize * 0.3;
        $tongueSize = $size * 0.08;

        // Draw dog head (slightly elongated)
        imagefilledellipse($image, $headX + $headSize / 2, $headY + $headSize / 2, $headSize * 1.1, $headSize, $color);

        // Generate random ear type
        $earType = $random ? $random->getInt(0, 3) : rand(0, 3);

        // Draw dog ears
        switch ($earType) {
            case 0: // Floppy ears
                $this->drawFloppyEars($image, $leftEarX, $rightEarX, $earY, $earSize, $color);
                break;
            case 1: // Pointy ears
                $this->drawPointyEars($image, $leftEarX, $rightEarX, $earY, $earSize, $color);
                break;
            case 2: // Round ears
                $this->drawRoundEars($image, $leftEarX, $rightEarX, $earY, $earSize, $color);
                break;
            case 3: // Semi-floppy ears
                $this->drawSemiFloppyEars($image, $leftEarX, $rightEarX, $earY, $earSize, $color);
                break;
        }

        // Generate random face type
        $faceType = $random ? $random->getInt(0, 3) : rand(0, 3);

        // Draw dog eyes (slightly smaller and more almond-shaped)
        switch ($faceType) {
            case 0: // Normal eyes
                $this->drawAlmondEyes($image, $leftEyeX, $rightEyeX, $eyeY, $eyeSize, $bgColor);
                break;
            case 1: // Sleepy eyes
                $this->drawSleepyEyes($image, $leftEyeX, $rightEyeX, $eyeY, $eyeSize, $bgColor);
                break;
            case 2: // Excited eyes
                $this->drawExcitedEyes($image, $leftEyeX, $rightEyeX, $eyeY, $eyeSize, $bgColor);
                break;
            case 3: // Winking eyes
                $this->drawWinkingEyes($image, $leftEyeX, $rightEyeX, $eyeY, $eyeSize, $bgColor);
                break;
        }

        // Draw dog nose (more detailed)
        $this->drawDetailedNose($image, $noseX, $noseY, $noseSize, $bgColor);

        // Draw dog mouth
        switch ($faceType) {
            case 0: // Normal mouth
                $this->drawNormalMouth($image, $noseX, $mouthY, $mouthWidth, $noseSize, $bgColor);
                break;
            case 1: // Panting mouth
                $this->drawPantingMouth($image, $noseX, $mouthY, $mouthWidth, $noseSize, $tongueSize, $bgColor);
                break;
            case 2: // Smiling mouth
                $this->drawSmilingMouth($image, $noseX, $mouthY, $mouthWidth, $noseSize, $bgColor);
                break;
            case 3: // Surprised mouth
                $this->drawSurprisedMouth($image, $noseX, $mouthY, $mouthWidth, $noseSize, $bgColor);
                break;
        }

        // Add random features
        $this->addRandomFeatures($image, $size, $color, $bgColor, $random);
    }

    private function drawFloppyEars($image, $leftEarX, $rightEarX, $earY, $earSize, $color)
    {
        // More curved floppy ears
        $points = [
            $leftEarX, $earY,
            $leftEarX - $earSize * 0.8, $earY + $earSize,
            $leftEarX - $earSize * 0.6, $earY + $earSize * 1.5,
            $leftEarX + $earSize * 0.4, $earY + $earSize * 1.2,
        ];
        imagefilledpolygon($image, $points, 4, $color);
        $points = [
            $rightEarX, $earY,
            $rightEarX + $earSize * 0.8, $earY + $earSize,
            $rightEarX + $earSize * 0.6, $earY + $earSize * 1.5,
            $rightEarX - $earSize * 0.4, $earY + $earSize * 1.2,
        ];
        imagefilledpolygon($image, $points, 4, $color);
    }

    private function drawPointyEars($image, $leftEarX, $rightEarX, $earY, $earSize, $color)
    {
        // More natural pointy ears
        $points = [
            $leftEarX, $earY + $earSize * 0.8,
            $leftEarX - $earSize * 0.6, $earY - $earSize * 0.4,
            $leftEarX + $earSize * 0.4, $earY,
        ];
        imagefilledpolygon($image, $points, 3, $color);
        $points = [
            $rightEarX, $earY + $earSize * 0.8,
            $rightEarX + $earSize * 0.6, $earY - $earSize * 0.4,
            $rightEarX - $earSize * 0.4, $earY,
        ];
        imagefilledpolygon($image, $points, 3, $color);
    }

    private function drawRoundEars($image, $leftEarX, $rightEarX, $earY, $earSize, $color)
    {
        // Slightly oval ears
        imagefilledellipse($image, $leftEarX, $earY, $earSize * 0.9, $earSize, $color);
        imagefilledellipse($image, $rightEarX, $earY, $earSize * 0.9, $earSize, $color);
    }

    private function drawSemiFloppyEars($image, $leftEarX, $rightEarX, $earY, $earSize, $color)
    {
        // More natural semi-floppy ears
        $points = [
            $leftEarX, $earY,
            $leftEarX - $earSize * 0.5, $earY - $earSize * 0.3,
            $leftEarX - $earSize * 0.8, $earY + $earSize * 0.8,
            $leftEarX + $earSize * 0.2, $earY + $earSize * 0.5,
        ];
        imagefilledpolygon($image, $points, 4, $color);
        $points = [
            $rightEarX, $earY,
            $rightEarX + $earSize * 0.5, $earY - $earSize * 0.3,
            $rightEarX + $earSize * 0.8, $earY + $earSize * 0.8,
            $rightEarX - $earSize * 0.2, $earY + $earSize * 0.5,
        ];
        imagefilledpolygon($image, $points, 4, $color);
    }

    private function drawAlmondEyes($image, $leftEyeX, $rightEyeX, $eyeY, $eyeSize, $bgColor)
    {
        // Almond-shaped eyes
        $this->drawAlmondShape($image, $leftEyeX, $eyeY, $eyeSize, $eyeSize * 0.6, $bgColor);
        $this->drawAlmondShape($image, $rightEyeX, $eyeY, $eyeSize, $eyeSize * 0.6, $bgColor);
    }

    private function drawSleepyEyes($image, $leftEyeX, $rightEyeX, $eyeY, $eyeSize, $bgColor)
    {
        // Sleepy, slightly curved lines
        imagearc($image, $leftEyeX, $eyeY, $eyeSize * 1.2, $eyeSize * 0.4, 0, 180, $bgColor);
        imagearc($image, $rightEyeX, $eyeY, $eyeSize * 1.2, $eyeSize * 0.4, 0, 180, $bgColor);
    }

    private function drawExcitedEyes($image, $leftEyeX, $rightEyeX, $eyeY, $eyeSize, $bgColor)
    {
        // Wide, slightly oval eyes
        imagefilledellipse($image, $leftEyeX, $eyeY, $eyeSize * 1.2, $eyeSize, $bgColor);
        imagefilledellipse($image, $rightEyeX, $eyeY, $eyeSize * 1.2, $eyeSize, $bgColor);
    }

    private function drawWinkingEyes($image, $leftEyeX, $rightEyeX, $eyeY, $eyeSize, $bgColor)
    {
        // One almond eye, one curved line
        $this->drawAlmondShape($image, $leftEyeX, $eyeY, $eyeSize, $eyeSize * 0.6, $bgColor);
        imagearc($image, $rightEyeX, $eyeY, $eyeSize * 1.2, $eyeSize * 0.4, 0, 180, $bgColor);
    }

    private function drawDetailedNose($image, $noseX, $noseY, $noseSize, $bgColor)
    {
        // Heart-shaped nose
        $points = [
            $noseX, $noseY,
            $noseX - $noseSize / 2, $noseY - $noseSize / 2,
            $noseX, $noseY - $noseSize / 4,
            $noseX + $noseSize / 2, $noseY - $noseSize / 2,
        ];
        imagefilledpolygon($image, $points, 4, $bgColor);
        // Add nostrils
        imagefilledellipse($image, $noseX - $noseSize / 4, $noseY, $noseSize / 6, $noseSize / 8, $bgColor);
        imagefilledellipse($image, $noseX + $noseSize / 4, $noseY, $noseSize / 6, $noseSize / 8, $bgColor);
    }

    private function drawNormalMouth($image, $noseX, $mouthY, $mouthWidth, $noseSize, $bgColor)
    {
        // Slightly curved line for mouth
        imagearc($image, $noseX, $mouthY, $mouthWidth, $noseSize, 0, 180, $bgColor);
    }

    private function drawPantingMouth($image, $noseX, $mouthY, $mouthWidth, $noseSize, $tongueSize, $bgColor)
    {
        // Oval mouth with tongue
        imagefilledellipse($image, $noseX, $mouthY + $noseSize / 2, $mouthWidth / 2, $noseSize, $bgColor);
        $tongueColor = imagecolorallocate($image, 255, 150, 150);
        imagefilledellipse($image, $noseX, $mouthY + $noseSize, $tongueSize, $tongueSize / 2, $tongueColor);
    }

    private function drawSmilingMouth($image, $noseX, $mouthY, $mouthWidth, $noseSize, $bgColor)
    {
        // Curved smiling mouth
        imagearc($image, $noseX, $mouthY, $mouthWidth, $noseSize * 2, 180, 360, $bgColor);
    }

    private function drawSurprisedMouth($image, $noseX, $mouthY, $mouthWidth, $noseSize, $bgColor)
    {
        // Small oval mouth
        imagefilledellipse($image, $noseX, $mouthY + $noseSize / 2, $mouthWidth / 3, $noseSize * 0.8, $bgColor);
    }

    private function drawAlmondShape($image, $x, $y, $width, $height, $color)
    {
        // Draw an almond shape
        $points = [];
        for ($i = 0; $i <= 180; $i++) {
            $points[] = $x + $width * cos(deg2rad($i)) / 2;
            $points[] = $y + $height * sin(deg2rad($i)) / 2;
        }
        for ($i = 180; $i >= 0; $i--) {
            $points[] = $x - $width * cos(deg2rad($i)) / 2;
            $points[] = $y + $height * sin(deg2rad($i)) / 2;
        }
        imagefilledpolygon($image, $points, count($points) / 2, $color);
    }

    private function addRandomFeatures($image, $size, $color, $bgColor, $random)
    {
        // Add spots or patches
        if ($random ? $random->getInt(0, 1) : rand(0, 1)) {
            $spotCount = $random ? $random->getInt(2, 6) : rand(2, 6);
            for ($i = 0; $i < $spotCount; $i++) {
                $spotX = $random ? $random->getInt(0, $size) : rand(0, $size);
                $spotY = $random ? $random->getInt(0, $size) : rand(0, $size);
                $spotSize = $random ? $random->getInt($size * 0.05, $size * 0.15) : rand($size * 0.05, $size * 0.15);
                imagefilledellipse($image, $spotX, $spotY, $spotSize, $spotSize * 0.8, $bgColor);
            }
        }

        // Add a collar
        if ($random ? $random->getInt(0, 1) : rand(0, 1)) {
            $collarY = $size * 0.8;
            $collarWidth = $size * 0.08;
            $collarColor = imagecolorallocate($image,
                $random ? $random->getInt(0, 255) : rand(0, 255),
                $random ? $random->getInt(0, 255) : rand(0, 255),
                $random ? $random->getInt(0, 255) : rand(0, 255)
            );
            imagefilledarc($image, $size / 2, $collarY, $size * 0.9, $collarWidth, 0, 180, $collarColor, IMG_ARC_PIE);

            // Add a dog tag
            $tagSize = $size * 0.06;
            $tagX = $size / 2;
            $tagY = $collarY + $collarWidth / 2;
            imagefilledellipse($image, $tagX, $tagY, $tagSize, $tagSize, $bgColor);
        }

        // Add whiskers
        $whiskerCount = 3;
        $whiskerLength = $size * 0.1;
        $whiskerY = $size * 0.6;
        for ($i = 0; $i < $whiskerCount; $i++) {
            $startX = $size * 0.3;
            $endX = $startX - $whiskerLength;
            $y = $whiskerY + ($i - 1) * $size * 0.02;
            imageline($image, $startX, $y, $endX, $y, $bgColor);

            $startX = $size * 0.7;
            $endX = $startX + $whiskerLength;
            imageline($image, $startX, $y, $endX, $y, $bgColor);
        }
    }
}
