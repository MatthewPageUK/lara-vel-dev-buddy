<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Enums;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use ReflectionEnum;
use ReflectionMethod;

class Getters
{
    /**
     * Get a collection of 'getter' ReflectionMethods that can be called on this enum.
     * Methods must start with 'get' and have no parameters.
     * eg. getLabel()
     */
    public static function get(ReflectionEnum $enum): Collection
    {
        return collect($enum->getMethods())
            ->filter(fn (ReflectionMethod $method) => static::isGetterMethod($method))
            ->sortKeys();
    }

    /**
     * @todo only int and string return types?
     * @todo protected private
     */
    protected static function isGetterMethod(ReflectionMethod $method): bool
    {
        return
            Str::of($method->getName())->startsWith('get') &&
            $method->getNumberOfParameters() === 0;
    }
}
