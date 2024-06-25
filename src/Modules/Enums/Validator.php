<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Enums;

use ReflectionEnum;

/**
 * Enum validator helpers for checking files and enums in the app.
 */
class Validator
{
    /**
     * Is the class an Enum?
     */
    public static function isEnum(string $class): bool
    {
        try {
            return (new ReflectionEnum($class))->isEnum();
        } catch (\Exception $e) {
            return false;
        }
    }
}
