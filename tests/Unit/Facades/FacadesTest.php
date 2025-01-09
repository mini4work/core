<?php

use M4W\Facades\Bits;
use M4W\Facades\Facade;
use M4W\Facades\Str;
use M4W\Framework;

beforeEach(function () {
    Framework::resetInstance();
    $framework = Framework::getInstance();
    $framework->make(\Tests\Helpers\TestKernel::class);
    Facade::setFacadeApplication($framework);
});

// App Facade

test('App facade returns current app instance', function () {
    $instance = Framework::getInstance();
    expect(\M4W\Facades\App::make('app'))->toBe($instance);
});

// Bits Facade

test('Test successful UTF-8 bits check', function (string $char) {
    expect(Bits::isUTF8StartByte(dechex(ord($char))))->toBeTrue();
})->with(['м', 'п', 'я', 'і', 'ї', 'Ї', 'И', 'Щ', 'Ю']);

test('Test wrong UTF-8 bits check', function (string $char) {
    expect(Bits::isUTF8StartByte(dechex(ord($char))))->toBeFalse();
})->with(['/', ' ', 'f', '+', 'U', '7', 'b', '^', '@']);

test('Test get two digit for hex', function (int $int) {
    expect(Bits::getTwoHexDigits($int))->toBeString()->toHaveLength(2);
})->with([0,1,2,4,7,8,9,63,64,65,127,128,129,254,255]);

test('Test get two digit for hex throws error', function (int $int) {
    expect(fn() => Bits::getTwoHexDigits($int))->toThrow(Exception::class, 'Input number not valid');
})->with([256, 280, -1, -20]);

// Str Facade

test('Check success change cyrillic character to latin', function (string $input, ?int $length, string $expected) {
    $result = Str::replaceTwoBitCharsToOne($input, $length);
    expect($result)->toBe($expected);
    if (!is_null($length)) {
        expect($length)->toBe(strlen($result))->toBe(strlen($expected))->and($expected)->toHaveLength(mb_strlen($input));
    }
})->with([
    ['Привіт', null, 'Пpивiт'],// expected has changed symbols from cyrillic to latin
    ['Привіт', 12, 'Привіт'],
    ['Привіт', 11, 'Пpивіт'], // expected has changed symbols from cyrillic to latin
    ['Привіт', 10, 'Пpивiт'],// expected has changed symbols from cyrillic to latin
]);

test('Check failed change cyrillic character to latin', function (string $input, ?int $length) {
    expect(fn() => Str::replaceTwoBitCharsToOne($input, $length))->toThrow(Exception::class, 'Can`t minimize text size');
})->with([
    ['Привіт', 9],
    ['Привіт', 8],
    ['qwerty', 5],
]);

test('Check success bits placement', function (string $input, int $length, string $expected) {
    expect(Str::addInvisibleCharsToLength($input, $length))->toBe($expected);
})->with([
    ['Привіт', 2, 'П'],
    ['Привіт', 4, 'Пр'],
    ['Привіт', 6, 'При'],
    ['Привіт', 8, 'Прив'],
    ['Привіт', 10, 'Приві'],
    ['Привіт', 12, 'Привіт'],
    ['Привіт', 13, 'Привіт '],
    ['Привіт', 14, 'Привіт '],
    ['Привіт', 15, 'Привіт​'],
    ['Привіт', 16, 'Привіт​ '],
    ['Привіт', 17, 'Привіт​ '],
    ['Привіт', 18, 'Привіт​​'],
    ['Привіт', 19, 'Привіт​​ '],
    ['Привіт', 20, 'Привіт​​ '],
    ['Привіт', 21, 'Привіт​​​'],
]);

test('Check success char swap with force', function (string $input, int $length, string $expected) {
    expect(Str::replaceTwoBitCharsToOne($input, $length, true))->toBe($expected);
})->with([
    ['Увалень', 14, 'Увалень'],
    ['Увалень', 13, 'Увaлень'],
    ['Увалень', 12, 'Увaлeнь'],
    ['Увалень', 11, 'Yвaлeнь'],
    ['Увалень', 10, 'Yвaлeнb'],
]);