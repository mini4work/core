<?php

namespace Miniwork;

class Framework extends Container
{
    protected array $bindings = [
        'strings' => \Miniwork\Services\StringService::class,
        'bits' => \Miniwork\Services\BitsManipulationService::class,
        'consoles' => \Miniwork\Services\ConsoleService::class,
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