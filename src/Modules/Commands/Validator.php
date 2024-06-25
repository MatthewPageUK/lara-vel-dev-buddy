<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Commands;

use Illuminate\Console\Command;
use MatthewPageUK\LaraVelDevBuddy\Support\Classes\Reflection;
use ReflectionClass;

/**
 * Commands validator helpers.
 */
class Validator
{
    /**
     * Is the class a Command?
     */
    public static function isCommand(string $class): bool
    {
        try {
            return static::isReflectionClassACommand(Reflection::make($class));
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Is the ReflectionClass a Command?
     */
    public static function isReflectionClassACommand(ReflectionClass $reflection): bool
    {
        return $reflection->isSubclassOf(Command::class) && ! $reflection->isAbstract();
    }
}