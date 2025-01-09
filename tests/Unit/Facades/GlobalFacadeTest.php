<?php

use M4W\Facades\Facade;
use M4W\Framework;
use Tests\Helpers\Counter;
use Tests\Helpers\CounterFacade;

beforeEach(function () {
    Framework::resetInstance();
    Facade::setFacadeApplication(null);
});

test('Prevent memory leak with shared concrete', function () {
    $app = Framework::getInstance();
    $app->bind('counter', Counter::class);

    expect(fn() => CounterFacade::setCounter(1))
        ->toThrow(Exception::class, 'Accessor is shared, memory leak possible');
});

test('Check we get exception when use facades without bindings', function () {
    expect(fn() => CounterFacade::getCounter())
        ->toThrow(Exception::class, 'Container don`t have bind '.CounterFacade::getFacadeAccessor());
});

test('Check we get exception when get not bound relation', function () {
    $name = 'counter';
    expect(fn() => app()->make($name))
        ->toThrow(Exception::class, 'Container don`t have bind '.$name);
});