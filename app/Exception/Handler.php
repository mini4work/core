<?php

namespace M4W\Core\Exception;

use M4W\Core\Enums\ConsoleStyles;
use M4W\Core\Facades\Console;
use Throwable;

class Handler
{
    public static function cause(Throwable $exception): void
    {
        $titleWidth = 70;
        $paddingSize = 3;
        $message = $exception->getMessage();

        $messageRows = str_split($message, 70 - ($paddingSize * 2));

        Console::writeLine(str_repeat(' ', $titleWidth), ConsoleStyles::BgRed);
        foreach ($messageRows as $messageRow) {
            Console::writeLine([
                [str_repeat(' ', $paddingSize), ConsoleStyles::BgRed],
                [$messageRow, ConsoleStyles::BgRed],
                [str_repeat(' ', $paddingSize + ($titleWidth - strlen($messageRow) - (2 * $paddingSize))), ConsoleStyles::BgRed],
            ]);
        }

        Console::writeLine(str_repeat(' ', $titleWidth), ConsoleStyles::BgRed);

        if (count($exception->getTrace())) {
            Console::writeLine(PHP_EOL.'Trace:', ConsoleStyles::FormatBoldOn);

            foreach ($exception->getTrace() as $trace) {
                $class = $trace['class'] ?? '???';
                $type = $trace['type'] ?? '/';
                $func = $trace['function'] ?? '???';

                $file = $trace['file'] ?? '';
                $line = $trace['line'] ?? '';

                $traceArray = $file.':'.$line.PHP_EOL
                    .$class.$type.$func.PHP_EOL
                    . json_encode($trace['args']);

                Console::writeLine($traceArray, ConsoleStyles::TextRed);
            }
        }
    }
}