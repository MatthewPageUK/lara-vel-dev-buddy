<?php

namespace MatthewPageUK\LaraVelDevBuddy\Support\Files;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

/**
 * File discovery helpers.
 */
class Discovery
{
    /**
     * Get a collection of SplFileInfo for all files in the app.
     */
    public static function getAll($path = null): Collection
    {
        if ($path === 'database') {
            return collect(File::allFiles(database_path()));
        }

        return collect(File::allFiles(app_path()));
    }
}