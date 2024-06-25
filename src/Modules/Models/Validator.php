<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Models;

use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

/**
 * Model validator helpers.
 */
class Validator
{
    /**
     * Is the class a Model?
     */
    public static function isModel(string $class): bool
    {
        try {
            return static::isReflectionClassAModel(new ReflectionClass($class));
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Is the ReflectionClass a Model?
     */
    public static function isReflectionClassAModel(ReflectionClass $reflection): bool
    {
        return $reflection->isSubclassOf(Model::class) &&
            ! $reflection->isAbstract();
    }
}