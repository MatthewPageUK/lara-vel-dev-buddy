<?php

namespace MatthewPageUK\LaraVelDevBuddy\Support\Traits;

use Illuminate\Support\Collection;
use ReflectionClass;
use ReflectionEnum;

class Discovery
{
    /**
     * Get the trait that a method is from
     */
    public static function getFromMethod(ReflectionClass $class, string $methodName): ?ReflectionClass
    {
        $traits = $class->getTraits();

        foreach ($traits as $trait) {
            if ($trait->hasMethod($methodName)) {
                return $trait;
            }
        }

        return null;
    }

    /**
     * Get the traits that an enum uses
     */
    public static function getFromEnum(ReflectionEnum $class): Collection
    {
        return collect($class->getTraits());
    }
}