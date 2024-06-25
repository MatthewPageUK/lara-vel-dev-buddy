<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Controllers;

use MatthewPageUK\LaraVelDevBuddy\Support\Classes;
use MatthewPageUK\LaraVelDevBuddy\Support\Files;
use ReflectionClass;
use SplFileInfo;

/**
 * Controller discovery helpers.
 */
class Discovery
{
    /**
     * Get a collection of ReflectionClasses for all Controllers in the app.
     */
    public static function getAll()
    {
        return Files\Discovery::getAll()
            ->map(fn (SplFileInfo $file) => Classes\Name::getFromFile($file))
            ->filter(fn (string $class) => Classes\Validator::isClass($class))
            ->filter(fn (string $class) => Validator::isController($class))
            ->map(fn (string $class): ReflectionClass => Classes\Reflection::make($class));
    }
}