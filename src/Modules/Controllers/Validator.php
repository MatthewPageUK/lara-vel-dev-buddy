<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Controllers;

use Illuminate\Routing\Controller;
use MatthewPageUK\LaraVelDevBuddy\Support\Classes\Reflection;
use ReflectionClass;

/**
 * Controllers validator helpers.
 */
class Validator
{
    /**
     * Is the class a Controller?
     */
    public static function isController(string $class): bool
    {
        try {
            return static::isReflectionClassAController(Reflection::make($class));
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Is the ReflectionClass a Controllers?
     */
    public static function isReflectionClassAController(ReflectionClass $reflection): bool
    {
        return $reflection->isSubclassOf(Controller::class) &&
            ! $reflection->isAbstract();
    }
}