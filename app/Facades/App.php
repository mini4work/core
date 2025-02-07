<?php

namespace M4W\Core\Facades;

/**
 * @method static object make(string $name)
 * @method static object resolve(string $name)
 */
class App extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return 'app';
    }
}