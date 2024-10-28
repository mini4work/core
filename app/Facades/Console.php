<?php

namespace Miniwork\Facades;

use Miniwork\Enums\ConsoleStyles;

/**
 * @method static string writeLine(string|array $line, ConsoleStyles $style = null)
 */
class Console extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'consoles';
    }
}