<?php

namespace M4W\Core\Providers;

use M4W\Core\Facades\Facade;
use M4W\Core\Services\BitsManipulationService;
use M4W\Core\Services\ConsoleService;
use M4W\Core\Services\StringService;

class FacadeServiceProvider extends AbstractServiceProvider
{
    protected array $facadeBindings = [
        'strings' => StringService::class,
        'bits' => BitsManipulationService::class,
        'consoles' => ConsoleService::class,
    ];

    public function register(): void
    {
        Facade::setFacadeApplication($this->app);

        foreach ($this->facadeBindings as $facade => $class) {
            $this->app->bind($facade, $class, true);
        }
    }
}