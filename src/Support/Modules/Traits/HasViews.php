<?php

namespace MatthewPageUK\LaraVelDevBuddy\Support\Modules\Traits;

/**
 * HasViews trait.
 */
trait HasViews
{
    public static function getBaseView(): string
    {
        return static::$baseView;
    }

    public static function getView(string $view, array $data = [])
    {
        return view(static::getBaseView() . '.' . $view, $data);
    }
}