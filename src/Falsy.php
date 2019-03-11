<?php

namespace Angle;

final class Falsy
{
    use Falsy\Inspection;

    /**
     * Internals passed in constructor
     * @var array $vars
     */
    protected $vars = [];

    /**
     * State of truth
     * @var bool $falsy
     */
    protected $falsy = false;

    /**
     * Creates a new Falsy instance
     * @param mixed $vars
     */
    public function __construct(...$vars)
    {
        $this->audit(...array_values($this->vars = $vars));
    }

    /**
     * Current state of truth
     * @return bool
     */
    public function isFalsy() : bool
    {
        return $this->falsy === true;
    }

    /**
     * Inverse the current state of truth
     * @return bool
     */
    public function isTruthy() : bool
    {
        return $this->isFalsy() === false;
    }

    /**
     * Change the state of truth
     * @param  bool $falsy
     * @return bool
     */
    private function setFalsy(bool $falsy = true) : bool
    {
        return $this->falsy = $falsy;
    }

    /**
     * Audits the falsiness of a variable set
     * @param  mixed $vars
     * @return bool
     */
    private function audit(...$vars) : bool
    {
        if ($this->isEmpty($vars)) {
            $this->setFalsy(true);
        }

        foreach ($vars as $var) {
            if ($this->isFalsy()) {
                continue;
            }

            if ($this->isNotSet($var)) {
                $this->setFalsy(true);
                continue;
            }

            if ($this->isClosure($var)) {
                $this->audit($var());
                continue;
            }

            if ($this->isArray($var)) {
                if ($this->isEmpty($var)) {
                    $this->setFalsy(true);
                    continue;
                }

                $this->audit(...array_values($var));
                continue;
            }

            if ($this->isObject($var)) {
                if ($this->hasMethod($var, 'toArray')) {
                    $this->audit($var->toArray());
                } else {
                    $this->audit((array) $var);
                }

                continue;
            }

            $this->setFalsy((bool) $var == false);
        }

        return $this->isFalsy();
    }
}
