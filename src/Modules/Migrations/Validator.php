<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Migrations;

use Illuminate\Database\Migrations\Migration;
use MatthewPageUK\LaraVelDevBuddy\Support\Classes\Reflection;
use ReflectionClass;
use SplFileInfo;

/**
 * Migrations validator helpers.
 */
class Validator
{
    /**
     * Is the file a Migration?
     */
    public static function isMigration(SplFileInfo $file): bool
    {
        try {
            return str_contains($file->getRelativePathName(), 'migrations/');
        } catch (\Exception $e) {
            return false;
        }
    }
}