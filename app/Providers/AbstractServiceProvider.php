<?php

namespace Miniwork\Providers;

use Miniwork\Framework;

abstract class AbstractServiceProvider
{
    public function __construct(protected Framework $app) {}

    abstract public function register();
}