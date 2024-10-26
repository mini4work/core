<?php

if (! function_exists('app')) {
    /**
     * @throws Exception
     */
    function app(string $abstract = null, array $parameters = [])
    {
        if (is_null($abstract)) {
            return \Container\Container::getInstance();
        }

        return \Container\Container::getInstance()->get($abstract, $parameters);
    }
}