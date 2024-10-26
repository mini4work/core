<?php

namespace App\Facades;

use Facades\AbstractFacade;

class App extends AbstractFacade
{
    public static function getFacadeAccessor(): string
    {
        return 'app';
    }
}