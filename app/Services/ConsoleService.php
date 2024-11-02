<?php

namespace Miniwork\Services;

use Miniwork\Enums\ConsoleStyles;

class ConsoleService
{
    public function writeLine(string|array $line, ConsoleStyles $style = null): void
    {
        if (is_null($style)) {
            $style = ConsoleStyles::TextDefault;
        }

        if (!is_array($line)) {
            echo $style->value . $line . ConsoleStyles::ResetAllAttributes->value . PHP_EOL;
            return;
        }

        $result = '';
        foreach ($line as $text) {
            if (is_array($text) && isset($text[1])) {
                $style = ($text[1] instanceof ConsoleStyles)?$text[1]->value:$text[1];
                $result .= $style . $text[0] . ConsoleStyles::ResetAllAttributes->value;
            } else {
                $result .= $text[0];
            }
        }

        echo $result . PHP_EOL;
    }
}