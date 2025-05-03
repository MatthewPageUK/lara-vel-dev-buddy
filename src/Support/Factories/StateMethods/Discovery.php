<?php

namespace MatthewPageUK\LaraVelDevBuddy\Support\Factories\StateMethods;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use ReflectionClass;

/**
 * Factory state methods discovery helpers.
 */
class Discovery
{
    /**
     * Get a collection of SplFileInfo for all files in the app.
     */
    public static function getFromFactory(ReflectionClass $class): Collection
    {
        // Get all methods from reflection class
        $methods = $class->getMethods();

        // Validate method is state method - state methods return and Factory type hint
        $stateMethods = collect($methods)->filter(function ($method) {
            return $method->isPublic() && $method->getReturnType() && $method->getReturnType()->getName() === 'Illuminate\Database\Eloquent\Factories\Factory';
        });

        return $stateMethods;
    }
}