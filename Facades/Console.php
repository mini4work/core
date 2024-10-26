<?php

namespace Miniwork\Facades;

use Miniwork\Enums\ConsoleStyles;

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