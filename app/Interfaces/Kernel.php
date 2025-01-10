<?php

namespace M4W\Core\Interfaces;

interface Kernel
{
    public function handle(): void;

    public function serviceProviders(): array;
}