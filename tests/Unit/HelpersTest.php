<?php

use Miniwork\Facades\App;
use Miniwork\Framework;
use Tests\Helpers\Counter;

afterEach(function () {
    Framework::resetInstance();
});

test('Check app() helper', function () {
    $instance = Framework::getInstance();
    $helperInstance = app();

    expect($helperInstance)->toBe($instance);
});

test('Check app() helper returns concrete objects', function () {
    $instance = Framework::getInstance();
    $instance->bind('counter', Counter::class, false);

    /** @var Counter $counterInstance */
    $counterInstance = $instance->get('counter');
    $counterInstance->setCount(5);

    /** @var Counter $counterHelperInstance */
    $counterHelperInstance = app('counter');

    expect($counterHelperInstance)->toBe($counterInstance)->and($counterHelperInstance->getCount())->toBe(5);
});