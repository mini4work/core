<?php

namespace M4W\Abstract;

use Exception;
use M4W\Framework;
use M4W\Interfaces\Kernel;
use M4W\Providers\AbstractServiceProvider;

abstract class AbstractKernel implements Kernel
{
    protected Framework $app;

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

    /**
     * @throws Exception
     */
    private function serviceProviderLoad(): void
    {
        $providers = $this->serviceProviders();

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