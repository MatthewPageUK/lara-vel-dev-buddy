<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Factories;

use MatthewPageUK\LaraVelDevBuddy\Support\Classes;
use MatthewPageUK\LaraVelDevBuddy\Support\Files;
use ReflectionClass;
use SplFileInfo;

/**
 * Factory discovery helpers.
 */
class Discovery
{
    /**
     * Get a collection of ReflectionClasses for all Factories in the app.
     */
    public static function getAll()
    {
        return Files\Discovery::getAll('database')
            // ->map(fn (SplFileInfo $file): string => Classes\Name::getFromFile($file))
            // ->filter(fn (string $class): bool => Classes\Validator::isClass($class))
            ->map(fn (SplFileInfo $file): string => 'Database\\' . $file->getRelativePathName())
            ->map(fn (string $file): string => str_replace('/', '\\', $file))
            ->map(fn (string $file): string => str_replace('\factories', '\Factories', $file))
            ->map(fn (string $file): string => str_replace('.php', '', $file))
            ->filter(fn (string $class): bool => Validator::isFactory($class))
            ->map(fn (string $class): ReflectionClass => Classes\Reflection::make($class))
            ;
    }
}