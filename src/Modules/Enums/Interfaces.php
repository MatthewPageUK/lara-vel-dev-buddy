<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Enums;

use ReflectionEnum;

class Interfaces
{
    /**
     * Get a collection of ReflectionInterfaces implemented by a single enum.
     */
    public static function get(ReflectionEnum $enum)
    {
        return collect($enum->getInterfaces())
            ->reject(fn ($interface) => $interface->isInternal());
    }

    /**
     * Get a collection of all ReflectionInterfaces implemented by enums.
     */
    public static function getAll()
    {
        $interfaces = collect();

        Discovery::getAll()
            ->each(function ($enum) use ($interfaces) {
                collect($enum->getInterfaces())
                    ->reject(fn ($interface) => $interface->isInternal())
                    ->each(function ($interface) use ($interfaces) {
                        $interfaces->push($interface);
                    });
            });

        return $interfaces
            ->unique()
            ->sort();
    }
}