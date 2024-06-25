<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use MatthewPageUK\LaraVelDevBuddy\Support\Classes\Reflection;
use ReflectionClass;

/**
 * Factories validator helpers.
 */
class Validator
{
    /**
     * Is the class a Factory?
     */
    public static function isFactory(string $class): bool
    {
        try {
            return static::isReflectionClassAFactory(Reflection::make($class));
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Is the ReflectionClass a Factory?
     */
    public static function isReflectionClassAFactory(ReflectionClass $reflection): bool
    {
        return $reflection->isSubclassOf(Factory::class) && ! $reflection->isAbstract();
    }
}