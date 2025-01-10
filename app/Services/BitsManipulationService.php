<?php

namespace M4W\Core\Services;

use Exception;

class BitsManipulationService
{
    public function isUTF8StartByte(string $hex): bool
    {
        return $hex >= 'c2' && $hex <= 'df';
    }

    /**
     * @throws Exception
     */
    public function getTwoHexDigits(int $number): string
    {
        if ($number > 255 || $number < 0) {
            throw new Exception('Input number not valid');
        }
        $hex = dechex($number);
        if ($number < 16) {
            $hex = '0' . $hex;
        }

        return $hex;
    }
}