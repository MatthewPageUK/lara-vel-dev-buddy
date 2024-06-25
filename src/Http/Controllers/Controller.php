<?php

namespace MatthewPageUK\LaraVelDevBuddy\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use MatthewPageUK\LaraVelDevBuddy\Support\Config;

class Controller extends BaseController
{
    public function __construct()
    {
        view()->share('config', Config::class);
    }
}
