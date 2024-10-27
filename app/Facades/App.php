<?php

namespace Miniwork\Facades;

/**
 * @method static object get(string $name)
 */
class App extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'app';
    }
}