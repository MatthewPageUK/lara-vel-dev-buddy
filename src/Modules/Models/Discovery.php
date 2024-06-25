<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Models;

use MatthewPageUK\LaraVelDevBuddy\Support\Classes;
use MatthewPageUK\LaraVelDevBuddy\Support\Files;
use SplFileInfo;

/**
 * Model discovery helpers.
 */
class Discovery
{
    /**
     * Get a collection of ReflectionClasses for all models in the app.
     */
    public static function getAll()
    {
        return Files\Discovery::getAll()
            ->map(fn (SplFileInfo $file) => Classes\Name::getFromFile($file))
            ->filter(fn (string $class) => Classes\Validator::isClass($class))
            ->filter(fn (string $class) => Validator::isModel($class))
            ->map(fn (string $class) => Classes\Reflection::make($class));
    }
}