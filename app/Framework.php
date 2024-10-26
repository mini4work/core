<?php

namespace Miniwork;

class Framework extends Container
{
    protected array $facadeBindings = [
        'strings' => \Miniwork\Services\StringService::class,
        'bits' => \Miniwork\Services\BitsManipulationService::class,
        'consoles' => \Miniwork\Services\ConsoleService::class,
    ];

    public function __construct()
    {
        parent::__construct();
        $this->resolveDefaultBindings();
    }

    protected function resolveDefaultBindings(): void
    {
        foreach ($this->facadeBindings as $abstract => $concrete) {
            $this->bind($abstract, $concrete, false);
        }
    }
}