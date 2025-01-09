<?php

namespace M4W\Exception;

use M4W\Enums\ConsoleStyles;
use M4W\Facades\Console;
use Throwable;

class Handler
{
    public static function cause(Throwable $exception): void
    {
        $titleWidth = 70;
        $preTab = 3;
        $message = $exception->getMessage();
        $messageLength = mb_strlen($message);
        $boxDelta = $titleWidth - $preTab - $messageLength;

        if ($boxDelta <= 0) {
            $message = str_repeat(' ', $preTab) . mb_substr($message, 0, $messageLength + $boxDelta - 4) . '…   ';
        } else {
            $message = str_repeat(' ', $preTab) . $message . str_repeat(' ', $boxDelta);
        }

        Console::writeLine(str_repeat(' ', $titleWidth), ConsoleStyles::BgRed);
        Console::writeLine($message, ConsoleStyles::BgRed);
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