<?php

use Miniwork\Facades\Bits;
use Miniwork\Facades\Str;
use Miniwork\Framework;

afterEach(function () {
    Framework::resetInstance();
});

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

