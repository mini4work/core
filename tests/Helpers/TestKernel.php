<?php

namespace Tests\Helpers;

use M4W\Core\Abstract\AbstractKernel;
use M4W\Core\Facades\Console;

class TestKernel extends AbstractKernel
{
    public function handle(): void
    {
        Console::writeLine('Hello World!');
    }

    public function serviceProviders(): array
    {
        return [];
    }
}
