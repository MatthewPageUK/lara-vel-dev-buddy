<?php

namespace MatthewPageUK\LaraVelDevBuddy\Support\Modules\Traits;

/**
 * HasViews trait.
 */
trait HasRoutes
{
    public static function getBaseRoute(): string
    {
        return static::$route;
    }

    public static function getRouteName(string $route): string
    {
        return static::getBaseRoute() . '.' . $route;
    }

    public static function getRoute(string $route, ...$args)
    {
        try {
            return route(static::getRouteName($route), $args);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}