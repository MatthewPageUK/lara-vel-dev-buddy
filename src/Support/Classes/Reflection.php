<?php

namespace MatthewPageUK\LaraVelDevBuddy\Support\Classes;

use ReflectionClass;

/**
 * Class reflection helpers.
 */
class Reflection
{
    /**
     * Create a new ReflectionClass instance.
     */
    public static function make(string $class): ReflectionClass
    {
        return new ReflectionClass($class);
    }
}