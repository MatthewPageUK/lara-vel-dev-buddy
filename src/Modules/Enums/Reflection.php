<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Enums;

use ReflectionEnum;

/**
 * Enum Reflection helpers.
 */
class Reflection
{
    /**
     * Make a new ReflectionEnum instance.
     */
    public static function make(string $class): ReflectionEnum
    {
        return new ReflectionEnum($class);
    }
}