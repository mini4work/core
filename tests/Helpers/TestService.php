<?php

namespace Tests\Helpers;

class TestService
{
    public function __construct(protected CounterInterface $counter) {}

    public function getCounter(): CounterInterface {
        return $this->counter;
    }
}