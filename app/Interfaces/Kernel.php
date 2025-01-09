<?php

namespace M4W\Interfaces;

interface Kernel
{
    public function handle(): void;

    public function serviceProviders(): array;
}