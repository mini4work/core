<?php

use Miniwork\Container;
use Tests\Helpers\Counter;

test('Check that container is singleton', function () {
    $container = new Container();
    $staticContainer = Container::getInstance();
    expect($staticContainer === $container)->toBeTrue();
});

test('Check that container can return different instances', function () {
    $container = new Container();
    $container->bind('test', Counter::class);

    expect($container->isShared('test'))->toBeTrue();

    /** @var Counter $counter1 */
    $counter1 = $container->get('test');
    $counter1->setCount(5);
    expect($counter1->getCount() === 5)->toBeTrue();

    /** @var Counter $counter2 */
    $counter2 = $container->get('test');
    $counter2->setCount(10);
    expect($counter2->getCount() === 10)->toBeTrue()
        ->and($counter1->getCount() !== $counter2->getCount())->toBeTrue();
});

test('Check that container can return same instance when its singleton', function () {
    $container = new Container();
    $container->singleton('test', Counter::class);

    expect($container->isShared('test'))->toBeFalse();

    /** @var Counter $counter1 */
    $counter1 = $container->get('test');
    $counter1->setCount(5);
    expect($counter1->getCount() === 5)->toBeTrue();

    /** @var Counter $counter2 */
    $counter2 = $container->get('test');
    $counter2->setCount(10);
    expect($counter2->getCount() === 10)->toBeTrue()
        ->and($counter1->getCount() === $counter2->getCount())->toBeTrue();
});