<?php

namespace Miniwork\Facades;

/**
 * @method static string replaceTwoBitCharsToOne(string $string, int|null $maxLength = null, bool $force = false)
 * @method static string addInvisibleCharsToLength(string $string, int $maxLength)
 */
class Str extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'strings';
    }
}