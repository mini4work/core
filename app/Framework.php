<?php

namespace Miniwork;

use Miniwork\Facades\Facade;

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
        $this->registerFacades();
    }

    protected function registerFacades(): void
    {
        Facade::setFacadeApplication($this);

        foreach ($this->facadeBindings as $facade => $class) {
            $this->bind($facade, $class, false);
        }
    }
}