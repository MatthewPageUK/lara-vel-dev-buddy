<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Enums;

use MatthewPageUK\LaraVelDevBuddy\Modules\Enums;
use MatthewPageUK\LaraVelDevBuddy\Support\Traits as TraitsSupport;
use ReflectionClass;
use ReflectionEnum;

class Traits
{
    /**
     * Get a collection of ReflectionTraits used by a single enum.
     */
    public static function get(ReflectionEnum $enum)
    {
        return TraitsSupport\Discovery::getFromEnum($enum)
            ->reject(fn (ReflectionClass $trait) => $trait->isInternal())
            ->sortKeys();
    }

    /**
     * Get a collection of all ReflectionClass Traits used by enums.
     */
    public static function getAll()
    {
        $traits = collect();

        Enums\Discovery::getAll()
            ->reject(fn (ReflectionEnum $enum) => $enum->isInternal())
            ->each(function (ReflectionEnum $enum) use ($traits) {
                collect($enum->getTraits())
                    ->each(function (ReflectionClass $trait) use ($traits) {
                        $traits->push($trait);
                    });
            });

        return $traits->unique()->sort();
    }
}
