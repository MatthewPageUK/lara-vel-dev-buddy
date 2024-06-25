<?php

namespace MatthewPageUK\LaraVelDevBuddy\Support\Classes;

use Illuminate\Container\Container;
use SplFileInfo;

/**
 * Class name helpers.
 */
class Name
{
    /**
     * Get the class name from the file path information and Container namespace.
     */
    public static function getFromFile(SplFileInfo $file): string
    {
        $path = $file->getRelativePathName();

        return sprintf('\%s%s',
            Container::getInstance()->getNamespace(),
            strtr(substr($path, 0, strrpos($path, '.')), '/', '\\')
        );
    }
}