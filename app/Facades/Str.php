<?php

namespace M4W\Core\Facades;

/**
 * @method static string replaceTwoBitCharsToOne(string $string, int|null $maxLength = null, bool $force = false)
 * @method static string swapChars(string $string, array $charsPairs, $maxLength = null)
 * @method static string addInvisibleCharsToLength(string $string, int $maxLength)
 */
class Str extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'strings';
    }
}