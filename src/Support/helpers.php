<?php

if (! function_exists('falsy')) {
    /**
     * Returns false unless all variables are truthy.
     * @param mixed $vars
     * @return bool
     */
    function falsy(...$vars) : bool
    {
        return (new \Angle\Falsy($vars))->isFalsy();
    }
}

if (! function_exists('truthy')) {
    /**
     * Returns true only when all variables are truthy.
     * @param mixed $vars
     * @return bool
     */
    function truthy(...$vars) : bool
    {
        return (new \Angle\Falsy($vars))->isTruthy();
    }
}
