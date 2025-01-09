<?php

use M4W\Framework;
use Tests\Helpers\Counter;
use Tests\Helpers\CounterInterface;
use Tests\Helpers\TestService;

test('Can make class with dependency', function () {
    $framework = Framework::getInstance();
    $framework->bind(CounterInterface::class, Counter::class);
    /** @var TestService $service */
    $service = $framework->make(TestService::class);
    $service->getCounter()->setCount(10);
    expect($service->getCounter()->getCount())->toBe(10);
});

test('We can`t resolve non-existing class', function () {
    $framework = Framework::getInstance();
    $concrete = 'testtest';
    expect(fn() => $framework->resolve($concrete))->toThrow(Exception::class, 'Class '.$concrete.' does not exist');
});

test('We can throw parameters if not need resolve', function () {
    $framework = Framework::getInstance();

    $counter = new Counter();

    /** @var TestService $service */
    $service = $framework->resolve(TestService::class, compact('counter'));

    expect($service->getCounter())->toBeInstanceOf(CounterInterface::class)->toBe($counter);
});