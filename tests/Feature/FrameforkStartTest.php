<?php

use Miniwork\Facades\App;
use Miniwork\Framework;

test('Can create framework', function () {
    $framework = new Framework;
    $self = $framework->get('app');
    expect($self)->toBeInstanceOf(Framework::class)->toBe($framework);
});