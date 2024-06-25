<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Enums;

use MatthewPageUK\LaraVelDevBuddy\Support\Classes;
use MatthewPageUK\LaraVelDevBuddy\Support\Files;
use SplFileInfo;

/**
 * Enum discovery helpers for finding enums in the app.
 */
class Discovery
{
    /**
     * Get a collection of ReflectionEnums for all enums in the app.
     */
    public static function getAll()
    {
        return Files\Discovery::getAll()
            ->map(fn (SplFileInfo $file) => Classes\Name::getFromFile($file))
            ->filter(fn (string $class) => Validator::isEnum($class))
            ->map(fn (string $class) => Reflection::make($class));
    }
}