<?php

namespace App\Facades;

use Enum\ConsoleStyles;
use Facades\AbstractFacade;

/**
 * @method static string markup(string $line, array|ConsoleStyles $style)
 */
class Console extends AbstractFacade
{
    public static function getFacadeAccessor(): string
    {
        return 'consoles';
    }
}