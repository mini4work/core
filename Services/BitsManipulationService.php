<?php

namespace Services;

class BitsManipulationService
{
    public function isUTF8StartByte(string $hex): bool
    {
        return $hex >= 'c2' && $hex <= 'df';
    }

    public function getTwoHexDigits(int $number): string
    {
        $hex = dechex($number);
        if ($number < 16) {
            $hex = '0' . $hex;
        }
        return $hex;
    }
}