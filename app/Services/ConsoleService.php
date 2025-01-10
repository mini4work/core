<?php

namespace M4W\Core\Services;

use M4W\Core\Enums\ConsoleStyles;

class ConsoleService
{
    public function writeLine(string|array|null $line = null, ?ConsoleStyles $style = null): void
    {
        if (is_null($line)) {
            echo PHP_EOL;
            return;
        }

        if (is_null($style)) {
            $style = ConsoleStyles::TextDefault;
        }

        if (!is_array($line)) {
            echo $style->format() . $line . ConsoleStyles::ResetAllAttributes() . PHP_EOL;
            return;
        }

        $result = '';
        foreach ($line as $text) {
            if (is_array($text) && isset($text[1])) {

                $style = $text[1];

                if ($text[1] instanceof ConsoleStyles) {
                    $style = $text[1]->format();
                }

                if (is_array($text[1])) {
                    $style = ConsoleStyles::applyStyles($text[1]);
                }

                $result .= $style . $text[0] . ConsoleStyles::ResetAllAttributes();
            } else {
                $result .= $text[0];
            }
        }

        echo $result . PHP_EOL;
    }
}