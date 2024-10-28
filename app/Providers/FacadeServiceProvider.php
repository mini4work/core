<?php

namespace Miniwork\Providers;

use Miniwork\Facades\Facade;

class FacadeServiceProvider extends AbstractServiceProvider
{
    protected array $facadeBindings = [
        'strings' => \Miniwork\Services\StringService::class,
        'bits' => \Miniwork\Services\BitsManipulationService::class,
        'consoles' => \Miniwork\Services\ConsoleService::class,
    ];

    public function register(): void
    {
        Facade::setFacadeApplication($this->app);

        foreach ($this->facadeBindings as $facade => $class) {
            $this->app->bind($facade, $class, true);
        }
    }
}