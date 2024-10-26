<?php

namespace Facades;

use Exception;

abstract class AbstractFacade
{
    abstract public static function getFacadeAccessor();

    /**
     * @throws Exception
     */
    public static function __callStatic($method, $parameters)
    {
        if (static::isSharedAccessor()) {
            throw new Exception('Accessor is shared, memory leak possible');
        }
        return static::getObject()->$method(...$parameters);
    }

    /**
     * @return bool
     * @throws Exception
     */
    private static function isSharedAccessor(): bool
    {
        return app()->isShared(static::getFacadeAccessor());
    }

    /**
     * @return object
     * @throws Exception
     */
    private static function getObject(): object
    {
        if (!app()->containerHas(static::getFacadeAccessor())) {
            throw new Exception('Facade accessor not registered');
        }
        return app(static::getFacadeAccessor());
    }
}