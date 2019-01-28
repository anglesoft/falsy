<?php

trait Inspection
{
    /**
     * Checks if variable is empty.
     * @param  array $var
     * @return bool
     */
    public function isEmpty(array $var) : bool
    {
        return empty($var);
    }

    /**
     * Checks if index is set.
     * @param  mixed $var
     * @return bool
     */
    public function isNotSet($var) : bool
    {
        return isset($var) === false;
    }

    /**
     * Checks if var is instance of closure.
     * @param  mixed $var
     * @return bool
     */
    public function isClosure($var) : bool
    {
        return $var instanceof \Closure;
    }

    /**
     * Checks if var is of type array.
     * @param  mixed $var
     * @return bool
     */
    public function isArray($var) : bool
    {
        return is_array($var);
    }

    /**
     * Checks if var is of object type.
     * @param  mixed $var
     * @return bool
     */
    public function isObject($var) : bool
    {
        return is_object($var);
    }

    /**
     * Checks if object implements a given method.
     * @param  mixed $object
     * @param  string $method
     * @return bool
     */
    public function hasMethod($object, string $method) : bool
    {
        return method_exists($object, $method);
    }
}
