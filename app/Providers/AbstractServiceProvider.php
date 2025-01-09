<?php

namespace M4W\Providers;

use M4W\Framework;

abstract class AbstractServiceProvider
{
    public function __construct(protected Framework $app) {}

    abstract public function register();
}