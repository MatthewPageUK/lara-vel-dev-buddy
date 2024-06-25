<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Routes;

use MatthewPageUK\LaraVelDevBuddy\Support\Classes;
use MatthewPageUK\LaraVelDevBuddy\Support\Files;
use ReflectionClass;
use SplFileInfo;
use Illuminate\Support\Facades\Route;

/**
 * Routes discovery helpers.
 */
class Discovery
{
    /**
     * Get a collection of Routes ????.
     */
    public static function getAll()
    {
        return collect(Route::getRoutes());
    }
}