<?php

namespace Miniwork\Exception;

use Miniwork\Enums\ConsoleStyles;
use Miniwork\Facades\Console;
use Throwable;

class Handler
{
    public static function cause(Throwable $exception): void
    {
        $titleWidth = 70;
        Console::writeLine(str_repeat(' ', $titleWidth), ConsoleStyles::BgRed);
        Console::writeLine(str_repeat(' ', 3).$exception->getMessage().str_repeat(' ', $titleWidth - 3 - mb_strlen($exception->getMessage())), ConsoleStyles::BgRed);
        Console::writeLine(str_repeat(' ', $titleWidth), ConsoleStyles::BgRed);

        if (count($exception->getTrace())) {
            Console::writeLine(PHP_EOL.'Trace:', ConsoleStyles::FormatBoldOn);

            foreach ($exception->getTrace() as $trace) {
                $class = $trace['class'] ?: '???';
                $type = $trace['type'] ?: '/';
                $func = $trace['function'] ?: '???';

                $file = $trace['file'] ?: '';
                $line = $trace['line'] ?: '';

                $traceArray = $file.':'.$line.PHP_EOL
                    .$class.$type.$func.PHP_EOL
                    . json_encode($trace['args']);

                Console::writeLine($traceArray, ConsoleStyles::TextRed);
            }
        }
    }
}