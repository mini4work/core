<?php

namespace M4W\Services;

use Exception;

class StringService
{
    /**
     * @param string $string
     * @param int|null $maxLength
     * @param bool $force
     * @return string
     * @throws Exception
     */
    public function replaceTwoBitCharsToOne(string $string, ?int $maxLength = null, bool $force = false): string
    {
        $replacePairs = [
            'а' => 'a', // cyrillic "a" to latin "a"
            'у' => 'y',
            'е' => 'e',
            'х' => 'x',
            'і' => 'i',
            'р' => 'p',
            'о' => 'o',
            'с' => 'c',
            'К' => 'K',
            'Е' => 'E',
            'Н' => 'H',
            'Х' => 'X',
            'І' => 'I',
            'В' => 'B',
            'А' => 'A',
            'Р' => 'P',
            'О' => 'O',
            'С' => 'C',
            'М' => 'M',
            'Т' => 'T',
        ];

        $forcePairs = [
            'и' => 'u',
            'к' => 'k',
            'г' => 'r',
            'З' => '3',
            'п' => 'n',
            'ь' => 'b',
            'У' => 'Y',
        ];

        $string = $this->swapChars($string, $replacePairs, $maxLength);

        if (!is_null($maxLength) && strlen($string) > $maxLength) {
            if ($force) {
                $string = $this->swapChars($string, $forcePairs, $maxLength);
            } else {
                throw new Exception('Can`t minimize text size');
            }
        }


        return $string;
    }

    public function swapChars(string $string, array $charsPairs, $maxLength = null): string
    {
        for ($i = 0; $i < mb_strlen($string); $i++) {
            $char = mb_substr($string, $i, 1);
            if (in_array($char, array_keys($charsPairs))) {

                // Change symbol only if string has more bytes than $maxLength
                if (!is_null($maxLength) && strlen($string) <= $maxLength) {
                    break;
                }

                // Concatenation for result (don`t play with string like array, when its multibyte =)
                $string = mb_substr($string, 0, $i).$charsPairs[$char].mb_substr($string, $i + 1);
            }
        }

        return $string;
    }

    public function addInvisibleCharsToLength(string $string, int $maxLength): string
    {
        if (strlen($string) > $maxLength) {
            return substr($string, 0, $maxLength);
        }

        while (intdiv($maxLength - strlen($string),  3)) {
            $string .= '​';
        }

        if (intdiv($maxLength - strlen($string),  2)) {
            $string .= ' ';
        }

        if (strlen($string) < $maxLength) {
            $string .= ' ';
        }

        return $string;
    }
}