<?php

namespace M4W\Core\Providers;

use M4W\Core\Framework;

abstract class AbstractServiceProvider
{
    public function __construct(protected Framework $app) {}

    abstract public function register(): void;
}