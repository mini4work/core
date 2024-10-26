<?php

namespace Miniwork\Facades;


class App extends AbstractFacade
{
    public static function getFacadeAccessor(): string
    {
        return 'app';
    }
}