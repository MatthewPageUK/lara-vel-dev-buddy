<?php

namespace MatthewPageUK\LaraVelDevBuddy\Support\Classes;

use ReflectionClass;

/**
 * Class validator helpers for checking files and classes in the app.
 */
class Validator
{
    /**
     * Is the class name an actual class?
     */
    public static function isClass(string $class): bool
    {
        try {
            new ReflectionClass($class);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }
}