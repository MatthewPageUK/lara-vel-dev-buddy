<?php

namespace MatthewPageUK\LaraVelDevBuddy\Http\Controllers;

use Illuminate\Support\Facades\Route;
use MatthewPageUK\LaraVelDevBuddy\Modules\Controllers;
use MatthewPageUK\LaraVelDevBuddy\Support;
use ReflectionMethod;

class ControllersController extends Controller
{
    public function index()
    {
        return Controllers\Module::getView('index', [
            'title' => 'LVDB - Controllers',
            'module' => Controllers\Module::class,
            'controllers' => Controllers\Discovery::getAll(),
        ]);
    }

    public function show($controller)
    {
        if (! Controllers\Validator::isController($controller)) {
            abort(404, 'This is not a controller');
        }

        $reflection = Support\Classes\Reflection::make($controller);

        $routes = collect(Route::getRoutes())->filter(function ($route) use ($controller) {
            return stripos($route->getActionName(), $controller) !== false;
        });

        $routes->map(function ($route) {
            return [
                'Method' => implode('|', $route->methods()),
                'URI' => $route->uri(),
                'Name' => $route->getName(),
                'Action' => $route->getActionName(),
            ];
        });

        $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);
        $views = [];

        foreach ($methods as $method) {
            $source = file($reflection->getFileName());
            $methodSource = implode("", array_slice($source, $method->getStartLine() - 1, $method->getEndLine() - $method->getStartLine() + 1));

            preg_match_all('/view\s*\(\s*[\'"]([^\'"]+)[\'"]/', $methodSource, $matches);
            foreach ($matches[1] as $view) {
                $views[] = [
                    'Method' => $method->getName(),
                    'View' => $view,
                ];
            }
        }

        return Controllers\Module::getView('view', [
            'title' => 'LVDB - Controllers - ' . $reflection->getShortName(),
            'module' => Controllers\Module::class,
            'controllers' => Controllers\Discovery::getAll(),
            'reflection' => $reflection,
            'comment' => $reflection->getDocComment(),
            'methods' => collect($reflection->getMethods()),
            'methodSignatures' => collect($reflection->getMethods())
                ->mapWithKeys(fn (ReflectionMethod $method) => [
                    $method->getShortName() => Support\Methods\Signature::get($method),
                ]),
            'methodTraits' => collect($reflection->getMethods())
                ->mapWithKeys(fn (ReflectionMethod $method) => [
                    $method->getShortName() => Support\Traits\Discovery::getFromMethod($reflection, $method->getName()),
                ]),
            'routes' => $routes,
            'views' => $views,
            'file' => Support\Files\Analysis::getFileInfo($reflection->getFileName()),
        ]);
    }
}