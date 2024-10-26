<?php

namespace Services;

class StringService
{
    public function replaceTwoBitCharsToOne(string $string, ?int $maxLength = null): string
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

        foreach ($replacePairs as $from => $to) {
            $string = str_replace($from, $to, $string);
            if (strlen($string) <= $maxLength) {
                break;
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