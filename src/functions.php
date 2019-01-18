<?php

if (! function_exists('falsy')) {
    /**
     * Returns true only when all variables are falsy.
     * @param mixed $vars
     * @var bool
     */
    function falsy(...$vars) : bool {
        foreach ($vars as $var) {
            if ($var instanceof \Closure) {
                if (count($vars) > 1) {
                    throw new \Angle\Falsy\Exceptions\FalsyClosureException;
                }

                return falsy($var());
            }

            if (is_array($var)) {
                if (empty($var)) {
                    return true;
                }

                return falsy(...array_values($var));
            }

            if (is_object($var)) {
                return falsy((array) $var);
            }

            if ((bool) $var === true) {
                return false;
            }
        }

        return true;
    }
}

if (! function_exists('nullsy')) {
    /**
     * Returns true only when all variables are nullsy.
     * @param mixed $vars
     * @var bool
     */
    // function nullsy(...$vars) : bool {
    //     foreach ($vars as $var) {
    //         if ($var instanceof \Closure) {
    //             if (count($vars) > 1) {
    //                 throw new \Angle\Falsy\Exceptions\FalsyClosureException;
    //             }
    //
    //             return nullsy($var());
    //         }
    //
    //         if (is_array($var)) {
    //             if (empty($var)) {
    //                 return true;
    //             }
    //
    //             return nullsy(...array_values($var));
    //         }
    //
    //         if (is_object($var)) {
    //             return nullsy((array) $var);
    //         }
    //
    //         if (is_numeric($var)) {
    //             return $var == 0;
    //         }
    //
    //         if ($var == null || (string) $var == '') {
    //             return true;
    //         }
    //     }
    //
    //     return true;
    // }
    //

    function nullsy(...$vars) : bool {
        foreach ($vars as $var) {
            if (is_array($var)) {
                if (empty($var)) {
                    return true;
                }

                return nullsy(...array_values($var));
            }

            if (is_object($var)) {
                return falsy((array) $var);
            }

            if (is_numeric($var)) {
                return (int) $var == 0;
            }

            if (is_bool($var)) {
                return $var == false;
            }

            if ($var != null || (string) $var != '') {
                return false;
            }
        }

        return true;
    }
}

if (! function_exists('truthy')) {
    /**
     * Returns true only when all variables are truthy.
     * @param mixed $vars
     * @var bool
     */
    function truthy(...$vars) : bool {
        foreach ($vars as $var) {
            if ($var instanceof \Closure) {
                if (count($vars) > 1) {
                    throw new \Angle\Falsy\Exceptions\FalsyClosureException;
                }

                return truthy($var());
            }

            if (is_array($var)) {
                if (empty($var)) {
                    return false;
                }

                return truthy(...array_values($var));
            }

            if (is_object($var)) {
                return truthy((array) $var);
            }

            if ((bool) $var === false) {
                return false;
            }
        }

        return true;
    }
}
