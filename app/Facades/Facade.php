<?php

namespace Miniwork\Facades;

use Exception;
use Miniwork\Container;

abstract class Facade
{
    protected static ?Container $app;

    abstract protected static function getFacadeAccessor();

    /**
     * @throws Exception
     */
    public static function __callStatic($method, $parameters)
    {
        if (static::isSharedAccessor()) {
            throw new Exception('Accessor is shared, memory leak possible');
        }
        return static::resolveFacadeInstance(static::getFacadeAccessor())->$method(...$parameters);
    }

    /**
     * @return bool
     * @throws Exception
     */
    private static function isSharedAccessor(): bool
    {
        return static::$app->isShared(static::getFacadeAccessor());
    }

    /**
     * @param string $name
     * @return object
     * @throws Exception
     */
    protected static function resolveFacadeInstance(string $name): object
    {
        if (!static::$app->containerHas($name)) {
            throw new Exception('Facade accessor not registered');
        }

        return static::$app->get(static::getFacadeAccessor());
    }

    /**
     * @return Container
     */
    protected static function getFacadeApplication(): Container
    {
        return static::$app;
    }

    /**
     * @param $app
     * @return void
     */
    public static function setFacadeApplication($app): void
    {
        static::$app = $app;
    }
}