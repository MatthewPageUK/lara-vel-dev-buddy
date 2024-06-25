<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Commands;

use MatthewPageUK\LaraVelDevBuddy\Support\Classes;
use MatthewPageUK\LaraVelDevBuddy\Support\Files;
use ReflectionClass;
use SplFileInfo;

/**
 * Command discovery helpers.
 */
class Discovery
{
    /**
     * Get a collection of ReflectionClasses for all Commands in the app.
     */
    public static function getAll()
    {
        return Files\Discovery::getAll()
            ->map(fn (SplFileInfo $file): string => Classes\Name::getFromFile($file))
            ->filter(fn (string $class): bool => Classes\Validator::isClass($class))
            ->filter(fn (string $class): bool => Validator::isCommand($class))
            ->map(fn (string $class): ReflectionClass => Classes\Reflection::make($class));
    }
}