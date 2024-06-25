<?php

namespace MatthewPageUK\LaraVelDevBuddy\Http\Controllers;

use Illuminate\Support\Facades\Route;
use MatthewPageUK\LaraVelDevBuddy\Modules\Routes;


class RoutesController extends Controller
{
    public function index()
    {
        return Routes\Module::getView('index', [
            'module' => Routes\Module::class,
            'routes' => Routes\Discovery::getAll()->sort(),
            'title' => 'LVDB - Routes',
        ]);
    }

    public function show($route)
    {
        $route = str_replace(']', '}', str_replace('[', '{', $route));

        return Routes\Module::getView('view', [
            'module' => Routes\Module::class,
            'routes' => Routes\Discovery::getAll()->sort(),
            'route' => Routes\Discovery::getAll()->firstWhere('uri', $route),
            'title' => 'LVDB - Route - ' . $route,
        ]);

    }
}