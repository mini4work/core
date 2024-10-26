<?php

namespace App;

use Container\Container;

class Framework extends Container
{
    protected array $bindings = [
        'strings' => \Services\StringService::class,
        'bits' => \Services\BitsManipulationService::class,
        'consoles' => \Services\ConsoleService::class,
    ];

    public function __construct()
    {
        static::setInstance($this);
        $this->singleton('app', $this);
        $this->singleton(Container::class, $this);
        $this->resolveDefaultBindings();
    }

    protected function resolveDefaultBindings(): void
    {
        foreach ($this->bindings as $abstract => $concrete) {
            $this->bind($abstract, $concrete, false);
        }
    }
}