<?php

namespace Tests\Helpers;

use Exception;
use M4W\Abstract\AbstractKernel;
use M4W\Facades\Console;
use M4W\Framework;
use M4W\Providers\AbstractServiceProvider;
use M4W\Providers\FacadeServiceProvider;

class TestKernel extends AbstractKernel
{

    public function handle(): void
    {
        Console::writeLine('Hello World!');
    }

    public function serviceProviders(): array
    {
        return [
            FacadeServiceProvider::class,
        ];
    }
}
