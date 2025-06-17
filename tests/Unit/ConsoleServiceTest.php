<?php

use M4W\Core\Services\ConsoleService;

beforeEach(function () {
    // nothing to reset
});

test('writeLine with array of strings outputs full strings', function () {
    $console = new ConsoleService();

    ob_start();
    $console->writeLine(['Hello', 'World']);
    $output = ob_get_clean();

    expect($output)->toBe("HelloWorld\n");
});
