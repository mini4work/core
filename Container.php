<?php

namespace Miniwork;

use Exception;

class Container
{
    protected static ?Container $instance = null;
    protected array $bindings = [];

    public static function getInstance(): Container
    {
        if (!isset(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }

    public static function setInstance(Container $container): Container
    {
        return static::$instance = $container;
    }

    public function bind(string $abstract, string|object|null $concrete = null, bool $shared = true): void
    {
        if (is_null($concrete)) {
            $concrete = $abstract;
        }

        $concreteName = $concrete;
        if (is_object($concrete)) {
            $concreteName = get_class($concrete);
        }

        $this->bindings[$abstract] = [
            'concrete' => $concreteName,
            'shared' => $shared,
        ];

        $this->bindings[$abstract]['objects'] = is_object($concrete)?[$concrete]:[];
    }

    public function singleton(string $abstract, string|object|null $concrete = null): void
    {
        $this->bind($abstract, $concrete, false);
    }

    public function isShared(string $abstract): bool
    {
        return isset($this->bindings[$abstract])?$this->bindings[$abstract]['shared']:false;
    }

    /**
     * @throws Exception
     */
    public function get(string $abstract, array $params): object
    {
        if (!$this->containerHas($abstract)) {
            if (!$this->classExists($abstract)) {
                throw new Exception("Container don`t have bindings $abstract");
            }

            $this->bind($abstract, new $abstract($params));
            return end($this->bindings[$abstract]['objects']);
        }

        $isShared = $this->bindings[$abstract]['shared'];
        $hasInstances = count($this->bindings[$abstract]['objects']);

        if ((!$isShared && !$hasInstances) || $isShared) {
            $this->bindings[$abstract]['objects'][] = new $this->bindings[$abstract]['concrete']($params);
        }

        return end($this->bindings[$abstract]['objects']);
    }

    public function containerHas(string $abstract): bool
    {
        return isset($this->bindings[$abstract]);
    }

    public function classExists(string $abstract): bool
    {
        return class_exists($abstract);
    }
}