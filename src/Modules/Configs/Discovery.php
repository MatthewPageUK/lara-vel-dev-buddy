<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Configs;

/**
 * Config discovery helpers.
 */
class Discovery
{
    /**
     * Get all the config values and settings.
     */
    public static function getAll()
    {
        return config()->all();
    }
}