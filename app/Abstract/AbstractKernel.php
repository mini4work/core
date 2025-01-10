<?php

namespace M4W\Core\Abstract;

use Exception;
use M4W\Core\Framework;
use M4W\Core\Interfaces\Kernel;
use M4W\Core\Providers\AbstractServiceProvider;
use M4W\Core\Providers\FacadeServiceProvider;

abstract class AbstractKernel implements Kernel
{
    protected Framework $app;

    protected bool $disableDefautlFacades = false;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->app = app();
        $this->serviceProviderLoad();
    }

    abstract public function handle(): void;

    abstract public function serviceProviders(): array;

    protected function allServiceProviders(): array
    {
        $defaultServiceProviders = [];

        if (!$this->disableDefautlFacades) {
            $defaultServiceProviders[] = FacadeServiceProvider::class;
        }

        return array_merge($defaultServiceProviders, $this->serviceProviders());
    }

    /**
     * @throws Exception
     */
    private function serviceProviderLoad(): void
    {
        $providers = $this->allServiceProviders();

        foreach ($providers as $provider) {
            if (!class_exists($provider)) {
                throw new Exception('Provider class ' . $provider . ' does not exist');
            }

            $providerInstance = new $provider($this->app);

            if (!($providerInstance instanceof AbstractServiceProvider)) {
                throw new Exception('Provider class ' . $provider . ' does not implement AbstractServiceProvider');
            }

            $providerInstance->register();
        }
    }
}