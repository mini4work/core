<?php

namespace Tests\Helpers;

interface CounterInterface
{
    public function setCount(int $counter): void;

    public function getCount(): ?int;
}