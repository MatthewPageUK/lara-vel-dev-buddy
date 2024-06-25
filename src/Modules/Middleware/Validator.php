<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Middleware;

use MatthewPageUK\LaraVelDevBuddy\Support\Classes\Reflection;
use ReflectionClass;

/**
 * Middleware validator helpers.
 */
class Validator
{
    /**
     * Is the class a Middleware?
     */
    public static function isMiddleware(string $class): bool
    {
        try {
            return static::isReflectionClassAMiddleware(Reflection::make($class));
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Is the ReflectionClass a Middleware?
     */
    public static function isReflectionClassAMiddleware(ReflectionClass $reflection): bool
    {
        return str_contains($reflection->getNamespaceName(), 'App\\Http\\Middleware');
        //return true;
        // return $reflection->isSubclassOf(Command::class) &&
        //     ! $reflection->isAbstract();
    }
}