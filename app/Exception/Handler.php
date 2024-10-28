<?php

namespace Miniwork\Exception;

use Throwable;

class Handler
{
    public static function cause(Throwable $exception): void
    {
        $errorString = PHP_EOL."\033[31m";
        $errorString .= '========================================================='.PHP_EOL;
        $errorString .= ' ||| '.$exception->getMessage().PHP_EOL;
        $errorString .= '========================================================='.PHP_EOL;
        $errorString .= PHP_EOL."\033[39m";
        $errorString .= 'Trace:'.PHP_EOL;
        $traceArray = [];

        foreach ($exception->getTrace() as $trace) {
            $class = $trace['class'] ?? '???';
            $type = $trace['type'] ?? '/';
            $func = $trace['function'] ?? '???';

            $file = $trace['file'] ?? '';
            $line = $trace['line'] ?? '';

            $traceArray[] = $file.':'.$line.PHP_EOL
            .$class.$type.$func.PHP_EOL
            . json_encode($trace['args']);
        }

        $errorString .= implode(PHP_EOL.PHP_EOL, $traceArray);

        echo $errorString.PHP_EOL;
    }
}