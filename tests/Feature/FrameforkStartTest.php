<?php

use M4W\Core\Container;
use M4W\Core\Facades\Facade;
use M4W\Core\Framework;
use Tests\Helpers\Counter;

beforeEach(function () {
    Framework::resetInstance();
    Facade::setFacadeApplication(null);
});

test('Check that container is singleton', function () {
    $container = new Framework();
    $staticContainer = Framework::getInstance();
    expect($staticContainer === $container)->toBeTrue();
});

test('Check that container can return different instances', function () {
    $container = new Framework();
    $container->bind('test', Counter::class);

    expect($container->isShared('test'))->toBeFalse();

    /** @var Counter $counter1 */
    $counter1 = $container->make('test');
    $counter1->setCount(5);
    expect($counter1->getCount() === 5)->toBeTrue();

    /** @var Counter $counter2 */
    $counter2 = $container->make('test');
    $counter2->setCount(10);
    expect($counter2->getCount() === 10)->toBeTrue()
        ->and($counter1->getCount() !== $counter2->getCount())->toBeTrue();
});

test('Check that container can return same instance when its singleton', function () {
    $container = Framework::getInstance();
    $container->singleton('test', Counter::class);

    expect($container->isShared('test'))->toBeTrue();

    /** @var Counter $counter1 */
    $counter1 = $container->make('test');
    $counter1->setCount(5);
    expect($counter1->getCount() === 5)->toBeTrue();

    /** @var Counter $counter2 */
    $counter2 = $container->make('test');
    $counter2->setCount(10);
    expect($counter2->getCount() === 10)->toBeTrue()
        ->and($counter1->getCount() === $counter2->getCount())->toBeTrue();
});

test('Can create framework', function () {
    $framework = new Framework;
    $self = $framework->make('app');
    expect($self)->toBeInstanceOf(Framework::class)->toBe($framework);
});

test('Container and framework resolves same', function () {
    $framework = Framework::getInstance();
    $container = Container::getInstance();
    expect($framework)->toBe($container);
});

test('Check we can bind class to itself', function () {
    $container = Framework::getInstance();
    $container->bind(Counter::class);
    expect(app()->make(Counter::class))->toBeInstanceOf(Counter::class);
});

test('Check we can get class without bindings', function () {
    $container = Framework::getInstance();
    expect(app()->make(Counter::class))->toBeInstanceOf(Counter::class);
});