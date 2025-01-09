<?php

namespace M4W\Providers;

use M4W\Facades\Facade;

class FacadeServiceProvider extends AbstractServiceProvider
{
    protected array $facadeBindings = [
        'strings' => \M4W\Services\StringService::class,
        'bits' => \M4W\Services\BitsManipulationService::class,
        'consoles' => \M4W\Services\ConsoleService::class,
    ];

    public function register(): void
    {
        Facade::setFacadeApplication($this->app);

        foreach ($this->facadeBindings as $facade => $class) {
            $this->app->bind($facade, $class, true);
        }
    }
}