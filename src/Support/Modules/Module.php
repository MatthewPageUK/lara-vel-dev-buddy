<?php

namespace MatthewPageUK\LaraVelDevBuddy\Support\Modules;

abstract class Module
{
    public static function getName(): string
    {
        return static::$name;
    }

    public static function getIcon(): string
    {
        return static::$icon;
    }
}
