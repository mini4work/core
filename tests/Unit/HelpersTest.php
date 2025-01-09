<?php

use M4W\Facades\Facade;
use M4W\Framework;
use Tests\Helpers\Counter;

beforeEach(function () {
    Framework::resetInstance();
    Facade::setFacadeApplication(null);
});

test('Check app() helper', function () {
    $instance = Framework::getInstance();
    $helperInstance = app();

    expect($helperInstance)->toBe($instance);
});

test('Check app() helper returns concrete objects', function () {
    $instance = Framework::getInstance();
    $instance->bind('counter', Counter::class, true);

    /** @var Counter $counterInstance */
    $counterInstance = $instance->make('counter');
    $counterInstance->setCount(5);

    /** @var Counter $counterHelperInstance */
    $counterHelperInstance = app('counter');

    expect($counterHelperInstance)->toBe($counterInstance)->and($counterHelperInstance->getCount())->toBe(5);
});