<?php

namespace Tests\Helpers;

use Exception;
use M4W\Framework;
use M4W\Providers\AbstractServiceProvider;
use M4W\Providers\FacadeServiceProvider;

class TestKernel
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

    /**
     * @throws Exception
     */
    public function handle(): void {}

    /**
     * @throws Exception
     */
    private function serviceProviderLoad(): void
    {
        $providers = [
            FacadeServiceProvider::class,
        ];

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
