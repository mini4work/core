<?php

namespace Miniwork\Services;

use Miniwork\Enums\ConsoleStyles;

class ConsoleService
{
    public function markup(string $line, array|ConsoleStyles $style): string
    {
        return $style.$line.ConsoleStyles::ResetAllAttributes->value;
    }
}