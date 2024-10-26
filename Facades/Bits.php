<?php

namespace Miniwork\Facades;


/**
 * @method static bool isUTF8StartByte(string $hex)
 * @method static string getTwoHexDigits(int $number)
 */
class Bits extends AbstractFacade
{
    public static function getFacadeAccessor(): string
    {
        return 'bits';
    }
}