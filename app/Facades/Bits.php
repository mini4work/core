<?php

namespace M4W\Facades;

/**
 * @method static bool isUTF8StartByte(string $hex)
 * @method static string getTwoHexDigits(int $number)
 */
class Bits extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'bits';
    }
}