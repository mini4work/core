<?php

use Miniwork\Facades\Bits;
use Miniwork\Framework;

afterEach(function () {
    Framework::resetInstance();
});

test('App facade returns current app instance', function () {
    $instance = Framework::getInstance();
    expect(\Miniwork\Facades\App::get('app'))->toBe($instance);
});