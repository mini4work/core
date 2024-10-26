<?php

namespace App\Facades;

use Facades\AbstractFacade;

/**
 * @method static string replaceTwoBitCharsToOne(string $string, int|null $maxLength = null)
 * @method static string addInvisibleCharsToLength(string $string, int $maxLength)
 */
class Str extends AbstractFacade
{
    public static function getFacadeAccessor(): string
    {
        return 'strings';
    }
}