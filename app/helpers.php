<?php

use M4W\Core\Framework;

if (!function_exists('app')) {
    /**
     * @throws Exception
     */
    function app(?string $abstract = null, array $parameters = [])
    {
        if (is_null($abstract)) {
            return Framework::getInstance();
        }

        return Framework::getInstance()->make($abstract, $parameters);
    }
}