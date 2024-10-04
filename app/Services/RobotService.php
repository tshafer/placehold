<?php

namespace App\Services;

class RobotService
{
    public function drawRobot($image, $size, $color, $bgColor, $seed)
    {
        // Use seed to generate consistent random choices
        $random = $seed ? (new \Random\Randomizer(new \Random\Engine\Mt19937(crc32($seed)))) : null;

        // Calculate sizes based on the overall image size
        $bodyWidth = $size * 0.6;
        $bodyHeight = $size * 0.4;
        $bodyX = ($size - $bodyWidth) / 2;
        $bodyY = $size * 0.5;
        $headSize = $size * 0.4;
        $headX = ($size - $headSize) / 2;
        $headY = $bodyY - $headSize * 0.8;
        $eyeSize = $size * 0.08;
        $eyeY = $headY + $headSize * 0.25;
        $leftEyeX = $headX + $headSize * 0.25 - $eyeSize / 2;
        $rightEyeX = $headX + $headSize * 0.75 - $eyeSize / 2;
        $mouthY = $headY + $headSize * 0.7;
        $mouthWidth = $headSize * 0.5;
        $mouthHeight = $size * 0.03;
        $antennaWidth = $size * 0.03;
        $antennaHeight = $size * 0.15;
        $antennaX = $headX + $headSize / 2 - $antennaWidth / 2;
        $armWidth = $size * 0.1;
        $armHeight = $size * 0.3;
        $legWidth = $size * 0.1;
        $legHeight = $size * 0.2;
        $legY = $bodyY + $bodyHeight;

        // Draw robot body
        imagefilledrectangle($image, $bodyX, $bodyY, $bodyX + $bodyWidth, $bodyY + $bodyHeight, $color);

        // Draw robot head
        imagefilledrectangle($image, $headX, $headY, $headX + $headSize, $headY + $headSize, $color);

        // Draw robot eyes
        $eyeType = $random ? $random->getInt(0, 2) : rand(0, 2);
        switch ($eyeType) {
            case 0: // Round eyes
                imagefilledellipse($image, $leftEyeX + $eyeSize / 2, $eyeY + $eyeSize / 2, $eyeSize, $eyeSize, $bgColor);
                imagefilledellipse($image, $rightEyeX + $eyeSize / 2, $eyeY + $eyeSize / 2, $eyeSize, $eyeSize, $bgColor);
                break;
            case 1: // Square eyes
                imagefilledrectangle($image, $leftEyeX, $eyeY, $leftEyeX + $eyeSize, $eyeY + $eyeSize, $bgColor);
                imagefilledrectangle($image, $rightEyeX, $eyeY, $rightEyeX + $eyeSize, $eyeY + $eyeSize, $bgColor);
                break;
            case 2: // Triangle eyes
                $points = [
                    $leftEyeX, $eyeY + $eyeSize,
                    $leftEyeX + $eyeSize / 2, $eyeY,
                    $leftEyeX + $eyeSize, $eyeY + $eyeSize,
                ];
                imagefilledpolygon($image, $points, 3, $bgColor);
                $points = [
                    $rightEyeX, $eyeY + $eyeSize,
                    $rightEyeX + $eyeSize / 2, $eyeY,
                    $rightEyeX + $eyeSize, $eyeY + $eyeSize,
                ];
                imagefilledpolygon($image, $points, 3, $bgColor);
                break;
        }

        // Draw robot mouth
        $mouthType = $random ? $random->getInt(0, 2) : rand(0, 2);
        switch ($mouthType) {
            case 0: // Rectangle mouth
                imagefilledrectangle($image, $headX + ($headSize - $mouthWidth) / 2, $mouthY, $headX + ($headSize + $mouthWidth) / 2, $mouthY + $mouthHeight, $bgColor);
                break;
            case 1: // Smile mouth
                imagearc($image, $headX + $headSize / 2, $mouthY, $mouthWidth, $mouthHeight * 4, 0, 180, $bgColor);
                break;
            case 2: // Zigzag mouth
                $zigzagPoints = [];
                $steps = 5;
                for ($i = 0; $i <= $steps; $i++) {
                    $x = $headX + ($headSize - $mouthWidth) / 2 + ($mouthWidth / $steps) * $i;
                    $y = $mouthY + ($i % 2 == 0 ? 0 : $mouthHeight);
                    $zigzagPoints[] = $x;
                    $zigzagPoints[] = $y;
                }
                imagepolygon($image, $zigzagPoints, count($zigzagPoints) / 2, $bgColor);
                break;
        }

        // Draw robot antenna
        $antennaType = $random ? $random->getInt(0, 1) : rand(0, 1);
        if ($antennaType == 0) {
            imagefilledrectangle($image, $antennaX, $headY - $antennaHeight, $antennaX + $antennaWidth, $headY, $color);
            imagefilledellipse($image, $antennaX + $antennaWidth / 2, $headY - $antennaHeight, $antennaWidth * 2, $antennaWidth * 2, $color);
        } else {
            imageline($image, $antennaX, $headY, $antennaX + $antennaWidth / 2, $headY - $antennaHeight, $color);
            imageline($image, $antennaX + $antennaWidth, $headY, $antennaX + $antennaWidth / 2, $headY - $antennaHeight, $color);
            imagefilledellipse($image, $antennaX + $antennaWidth / 2, $headY - $antennaHeight, $antennaWidth * 2, $antennaWidth * 2, $color);
        }

        // Draw robot arms with random positions
        $armPositions = ['up', 'middle', 'down'];
        $leftArmPosition = $random ? $armPositions[$random->getInt(0, count($armPositions) - 1)] : $armPositions[array_rand($armPositions)];
        $rightArmPosition = $random ? $armPositions[$random->getInt(0, count($armPositions) - 1)] : $armPositions[array_rand($armPositions)];

        $this->drawArm($image, $bodyX - $armWidth, $bodyY, $armWidth, $armHeight, $color, $leftArmPosition);
        $this->drawArm($image, $bodyX + $bodyWidth, $bodyY, $armWidth, $armHeight, $color, $rightArmPosition);

        // Draw robot legs
        $legType = $random ? $random->getInt(0, 1) : rand(0, 1);
        if ($legType == 0) {
            imagefilledrectangle($image, $bodyX + $bodyWidth * 0.25 - $legWidth / 2, $legY, $bodyX + $bodyWidth * 0.25 + $legWidth / 2, $legY + $legHeight, $color);
            imagefilledrectangle($image, $bodyX + $bodyWidth * 0.75 - $legWidth / 2, $legY, $bodyX + $bodyWidth * 0.75 + $legWidth / 2, $legY + $legHeight, $color);
        } else {
            imagefilledellipse($image, $bodyX + $bodyWidth * 0.25, $legY + $legHeight / 2, $legWidth, $legHeight, $color);
            imagefilledellipse($image, $bodyX + $bodyWidth * 0.75, $legY + $legHeight / 2, $legWidth, $legHeight, $color);
        }

        // Add random decorations
        $this->addRandomDecorations($image, $size, $color, $bgColor, $random);
    }

    private function drawArm($image, $x, $y, $width, $height, $color, $position)
    {
        switch ($position) {
            case 'up':
                imagefilledrectangle($image, $x, $y - $height * 0.6, $x + $width, $y + $height * 0.4, $color);
                break;
            case 'middle':
                imagefilledrectangle($image, $x, $y, $x + $width, $y + $height, $color);
                break;
            case 'down':
                imagefilledrectangle($image, $x, $y + $height * 0.2, $x + $width, $y + $height * 1.2, $color);
                break;
        }
    }

    private function addRandomDecorations($image, $size, $color, $bgColor, $random)
    {
        // Add bolts
        $boltSize = $size * 0.03;
        $boltPositions = [
            [$size * 0.2, $size * 0.2],
            [$size * 0.8, $size * 0.2],
            [$size * 0.2, $size * 0.8],
            [$size * 0.8, $size * 0.8],
        ];
        foreach ($boltPositions as $position) {
            imagefilledellipse($image, $position[0], $position[1], $boltSize, $boltSize, $bgColor);
        }

        // Add a random pattern on the body
        $patternType = $random ? $random->getInt(0, 2) : rand(0, 2);
        $bodyX = ($size - $size * 0.6) / 2;
        $bodyY = $size * 0.5;
        $bodyWidth = $size * 0.6;
        $bodyHeight = $size * 0.4;

        switch ($patternType) {
            case 0: // Stripes
                for ($i = 0; $i < 5; $i++) {
                    $y = $bodyY + ($bodyHeight / 5) * $i;
                    imageline($image, $bodyX, $y, $bodyX + $bodyWidth, $y, $bgColor);
                }
                break;
            case 1: // Dots
                for ($i = 0; $i < 3; $i++) {
                    for ($j = 0; $j < 3; $j++) {
                        $x = $bodyX + ($bodyWidth / 3) * $i + $bodyWidth / 6;
                        $y = $bodyY + ($bodyHeight / 3) * $j + $bodyHeight / 6;
                        imagefilledellipse($image, $x, $y, $size * 0.03, $size * 0.03, $bgColor);
                    }
                }
                break;
            case 2: // Squares
                for ($i = 0; $i < 2; $i++) {
                    for ($j = 0; $j < 2; $j++) {
                        $x = $bodyX + ($bodyWidth / 2) * $i + $bodyWidth / 8;
                        $y = $bodyY + ($bodyHeight / 2) * $j + $bodyHeight / 8;
                        imagefilledrectangle($image, $x, $y, $x + $bodyWidth / 4, $y + $bodyHeight / 4, $bgColor);
                    }
                }
                break;
        }
    }
}
