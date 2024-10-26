<?php

use Miniwork\Container;

if (! function_exists('app')) {
    /**
     * @throws Exception
     */
    function app(string $abstract = null, array $parameters = [])
    {
        if (is_null($abstract)) {
            return Container::getInstance();
        }

        return Container::getInstance()->get($abstract, $parameters);
    }
}