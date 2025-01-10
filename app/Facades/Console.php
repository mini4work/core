<?php

namespace M4W\Core\Facades;

use M4W\Core\Enums\ConsoleStyles;

/**
 * @method static string writeLine(string|array|null $line = null, ?ConsoleStyles $style = null)
 */
class Console extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'consoles';
    }
}