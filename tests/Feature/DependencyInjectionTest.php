<?php

use Miniwork\Framework;
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