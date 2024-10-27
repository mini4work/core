<?php

use Miniwork\Facades\Bits;
use Miniwork\Facades\Facade;
use Miniwork\Framework;

beforeEach(function () {
    Framework::resetInstance();
    Facade::setFacadeApplication(null);
});

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