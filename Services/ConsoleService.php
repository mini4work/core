<?php

namespace Services;

use Enum\ConsoleStyles;

class ConsoleService
{
    public function markup(string $line, array|ConsoleStyles $style): string
    {
        return $style.$line.ConsoleStyles::ResetAllAttributes->value;
    }
}