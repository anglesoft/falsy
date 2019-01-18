<?php

namespace Angle\Falsy\Exceptions;

final class FalsyClosureException extends \InvalidArgumentException
{
    protected $message = "Can't compare closure objects with other variables. Use return value instead.";
}
