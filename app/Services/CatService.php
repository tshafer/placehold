<?php

namespace App\Services;

class CatService
{
    public function drawCat($image, $size, $color, $bgColor, $seed)
    {
        // Use seed to generate consistent random choices
        $random = $seed ? (new \Random\Randomizer(new \Random\Engine\Mt19937(crc32($seed)))) : null;

        // Calculate sizes based on the overall image size
        $headSize = $size * 0.7;
        $headX = ($size - $headSize) / 2;
        $headY = ($size - $headSize) / 2;
        $earSize = $size * 0.2;
        $leftEarX = $headX + $headSize * 0.2;
        $rightEarX = $headX + $headSize * 0.8;
        $earY = $headY;
        $eyeSize = $size * 0.1;
        $eyeY = $headY + $headSize * 0.4;
        $leftEyeX = $headX + $headSize * 0.3;
        $rightEyeX = $headX + $headSize * 0.7;
        $noseSize = $size * 0.05;
        $noseX = $headX + $headSize / 2;
        $noseY = $headY + $headSize * 0.6;
        $mouthY = $noseY + $noseSize;
        $mouthWidth = $headSize * 0.3;
        $whiskerLength = $headSize * 0.3;
        $whiskerY = $noseY;
        $whiskerSpacing = $whiskerLength / 4;

        // Draw cat head
        imagefilledellipse($image, $headX + $headSize / 2, $headY + $headSize / 2, $headSize, $headSize, $color);

        // Generate random ear type
        $earType = $random ? $random->getInt(0, 3) : rand(0, 3);

        // Draw cat ears
        switch ($earType) {
            case 0: // Pointy ears
                $this->drawPointyEars($image, $leftEarX, $rightEarX, $earY, $earSize, $color);
                break;
            case 1: // Rounded ears
                $this->drawRoundedEars($image, $leftEarX, $rightEarX, $earY, $earSize, $color);
                break;
            case 2: // Folded ears
                $this->drawFoldedEars($image, $leftEarX, $rightEarX, $earY, $earSize, $color);
                break;
            case 3: // Tufted ears
                $this->drawTuftedEars($image, $leftEarX, $rightEarX, $earY, $earSize, $color);
                break;
        }

        // Generate random face type
        $faceType = $random ? $random->getInt(0, 3) : rand(0, 3);

        // Draw cat eyes
        switch ($faceType) {
            case 0: // Normal eyes
                imagefilledellipse($image, $leftEyeX, $eyeY, $eyeSize, $eyeSize, $bgColor);
                imagefilledellipse($image, $rightEyeX, $eyeY, $eyeSize, $eyeSize, $bgColor);
                break;
            case 1: // Sleepy eyes
                imageline($image, $leftEyeX - $eyeSize / 2, $eyeY, $leftEyeX + $eyeSize / 2, $eyeY, $bgColor);
                imageline($image, $rightEyeX - $eyeSize / 2, $eyeY, $rightEyeX + $eyeSize / 2, $eyeY, $bgColor);
                break;
            case 2: // Surprised eyes
                imageellipse($image, $leftEyeX, $eyeY, $eyeSize, $eyeSize, $bgColor);
                imageellipse($image, $rightEyeX, $eyeY, $eyeSize, $eyeSize, $bgColor);
                break;
            case 3: // Winking eyes
                imagefilledellipse($image, $leftEyeX, $eyeY, $eyeSize, $eyeSize, $bgColor);
                imageline($image, $rightEyeX - $eyeSize / 2, $eyeY, $rightEyeX + $eyeSize / 2, $eyeY, $bgColor);
                break;
        }

        // Draw cat nose
        imagefilledellipse($image, $noseX, $noseY, $noseSize, $noseSize, $bgColor);

        // Draw cat mouth
        switch ($faceType) {
            case 0: // Normal mouth
                imageline($image, $noseX - $mouthWidth / 2, $mouthY, $noseX, $mouthY + $noseSize, $bgColor);
                imageline($image, $noseX + $mouthWidth / 2, $mouthY, $noseX, $mouthY + $noseSize, $bgColor);
                break;
            case 1: // Sleepy mouth
                imagearc($image, $noseX, $mouthY, $mouthWidth, $noseSize, 0, 180, $bgColor);
                break;
            case 2: // Surprised mouth
                imageellipse($image, $noseX, $mouthY + $noseSize / 2, $mouthWidth / 2, $noseSize, $bgColor);
                break;
            case 3: // Winking mouth
                imagearc($image, $noseX, $mouthY, $mouthWidth, $noseSize, 180, 360, $bgColor);
                break;
        }

        // Draw cat whiskers with random variations
        $whiskerCount = $random ? $random->getInt(3, 5) : rand(3, 5);

        for ($i = 0; $i < $whiskerCount; $i++) {
            $whiskerAngle = $random ? $random->getInt(-20, 20) : mt_rand(-20, 20);
            $whiskerYOffset = $random ? $random->getInt(-10, 10) : rand(-10, 10);

            // Left whiskers
            $startX = $leftEyeX;
            $startY = $whiskerY + $whiskerYOffset;
            $endX = $startX - $whiskerLength * cos(deg2rad($whiskerAngle));
            $endY = $startY - $whiskerLength * sin(deg2rad($whiskerAngle));
            imageline($image, $startX, $startY, $endX, $endY, $bgColor);

            // Right whiskers
            $startX = $rightEyeX;
            $startY = $whiskerY + $whiskerYOffset;
            $endX = $startX + $whiskerLength * cos(deg2rad($whiskerAngle));
            $endY = $startY - $whiskerLength * sin(deg2rad($whiskerAngle));
            imageline($image, $startX, $startY, $endX, $endY, $bgColor);

            $whiskerY += $whiskerSpacing;
        }

        // Add random features
        $this->addRandomFeatures($image, $size, $color, $bgColor, $random);
    }

    private function drawPointyEars($image, $leftEarX, $rightEarX, $earY, $earSize, $color)
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

    private function drawRoundedEars($image, $leftEarX, $rightEarX, $earY, $earSize, $color)
    {
        imagefilledellipse($image, $leftEarX, $earY, $earSize, $earSize, $color);
        imagefilledellipse($image, $rightEarX, $earY, $earSize, $earSize, $color);
    }

    private function drawFoldedEars($image, $leftEarX, $rightEarX, $earY, $earSize, $color)
    {
        $points = [
            $leftEarX, $earY + $earSize,
            $leftEarX - $earSize / 2, $earY,
            $leftEarX + $earSize / 4, $earY + $earSize / 2,
        ];
        imagefilledpolygon($image, $points, 3, $color);
        $points = [
            $rightEarX, $earY + $earSize,
            $rightEarX + $earSize / 2, $earY,
            $rightEarX - $earSize / 4, $earY + $earSize / 2,
        ];
        imagefilledpolygon($image, $points, 3, $color);
    }

    private function drawTuftedEars($image, $leftEarX, $rightEarX, $earY, $earSize, $color)
    {
        $this->drawPointyEars($image, $leftEarX, $rightEarX, $earY, $earSize, $color);
        imageline($image, $leftEarX - $earSize / 4, $earY, $leftEarX, $earY - $earSize / 2, $color);
        imageline($image, $rightEarX + $earSize / 4, $earY, $rightEarX, $earY - $earSize / 2, $color);
    }

    private function addRandomFeatures($image, $size, $color, $bgColor, $random)
    {
        // Add spots
        if ($random ? $random->getInt(0, 1) : rand(0, 1)) {
            $spotCount = $random ? $random->getInt(1, 5) : rand(1, 5);
            for ($i = 0; $i < $spotCount; $i++) {
                $spotX = $random ? $random->getInt(0, $size) : rand(0, $size);
                $spotY = $random ? $random->getInt(0, $size) : rand(0, $size);
                $spotSize = $random ? $random->getInt($size * 0.05, $size * 0.1) : rand($size * 0.05, $size * 0.1);
                imagefilledellipse($image, $spotX, $spotY, $spotSize, $spotSize, $bgColor);
            }
        }

        // Add stripes
        if ($random ? $random->getInt(0, 1) : rand(0, 1)) {
            $stripeCount = $random ? $random->getInt(2, 5) : rand(2, 5);
            $stripeWidth = $size / 20;
            for ($i = 0; $i < $stripeCount; $i++) {
                $stripeY = $random ? $random->getInt(0, $size) : rand(0, $size);
                imageline($image, 0, $stripeY, $size, $stripeY, $bgColor);
                imagefilledrectangle($image, 0, $stripeY - $stripeWidth / 2, $size, $stripeY + $stripeWidth / 2, $bgColor);
            }
        }

        // Add a collar
        if ($random ? $random->getInt(0, 1) : rand(0, 1)) {
            $collarY = $size * 0.8;
            $collarWidth = $size * 0.1;
            $collarColor = imagecolorallocate($image,
                $random ? $random->getInt(0, 255) : rand(0, 255),
                $random ? $random->getInt(0, 255) : rand(0, 255),
                $random ? $random->getInt(0, 255) : rand(0, 255)
            );
            imagefilledarc($image, $size / 2, $collarY, $size, $collarWidth, 0, 180, $collarColor, IMG_ARC_PIE);
        }
    }
}
