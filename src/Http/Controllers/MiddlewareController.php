<?php

namespace MatthewPageUK\LaraVelDevBuddy\Http\Controllers;

use MatthewPageUK\LaraVelDevBuddy\Modules\Middleware;
use MatthewPageUK\LaraVelDevBuddy\Support\Classes\Reflection;
use MatthewPageUK\LaraVelDevBuddy\Support;
use App\Http\Kernel;
use ReflectionClass;
use ReflectionMethod;

class MiddlewareController extends Controller
{
    public function index(Kernel $kernel)
    {
        // Get the middleware from the Kernel (protected var with no getter)
        $reflection = new ReflectionClass($kernel);
        $property = $reflection->getProperty('middleware');
        $property->setAccessible(true);

        $middlewareGlobal = collect($property->getValue($kernel))
            ->map(fn (string $middleware) => (object)[
                'name' => $middleware,
                'url' => str_starts_with($middleware, 'App\\Http') ? Middleware\Module::getRoute('show', $middleware) : null,
            ]);
        $middlewareGroups = $kernel->getMiddlewareGroups();
        $middlewareAlias = $kernel->getRouteMiddleware();

        return Middleware\Module::getView('index', [
            'title' => 'LVDB - Middleware',
            'module' => Middleware\Module::class,
            'middlewares' => Middleware\Discovery::getAll(),
            'middlewareGlobal' => $middlewareGlobal,
            'middlewareGroups' => $middlewareGroups,
            'middlewareAlias' => $middlewareAlias,
        ]);
    }

    public function show($middleware)
    {
        if (Middleware\Validator::isMiddleware($middleware) === false) {
            abort(404, 'This is not a middleware');
        }
        $reflection = Reflection::make($middleware);

        return Middleware\Module::getView('view', [
            'title' => 'LVDB - Middleware - ' . $reflection->getShortName(),
            'module' => Middleware\Module::class,
            'middlewares' => Middleware\Discovery::getAll(),
            'reflection' => $reflection,
            'file' => Support\Files\Analysis::getFileInfo($reflection->getFileName()),
            // 'instance' => new $command,
            'comment' => $reflection->getDocComment(),
            'methods' => collect($reflection->getMethods())->sort(),
            'methodSignatures' => collect($reflection->getMethods())
                ->mapWithKeys(fn (ReflectionMethod $method) => [
                    $method->getShortName() => Support\Methods\Signature::get($method),
                ]),
            // 'methodTraits' => collect($reflection->getMethods())
            //     ->mapWithKeys(fn (ReflectionMethod $method) => [
            //         $method->getShortName() => Traits\Discovery::getFromMethod($reflection, $method->getName()),
            //     ]),
        ]);
    }
}