<?php

namespace MatthewPageUK\LaraVelDevBuddy\Http\Controllers;

use MatthewPageUK\LaraVelDevBuddy\Modules\Commands;
use MatthewPageUK\LaraVelDevBuddy\Support;
use ReflectionMethod;

class CommandsController extends Controller
{
    public function index()
    {
        return Commands\Module::getView('index', [
            'title' => 'LVDB - Commands',
            'module' => Commands\Module::class,
            'commands' => Commands\Discovery::getAll(),
        ]);
    }

    public function show($command)
    {
        if (! Commands\Validator::isCommand($command)) {
            abort(404, 'This is not a command');
        }

        $reflection = Support\Classes\Reflection::make($command);
        $instance = new $command;

        return Commands\Module::getView('view', [
            'title' => 'LVDB - Commands - ' . $reflection->getShortName(),
            'module' => Commands\Module::class,
            'commands' => Commands\Discovery::getAll(),
            'reflection' => $reflection,
            'file' => Support\Files\Analysis::getFileInfo($reflection->getFileName()),
            'instance' => $instance,
            'comment' => $reflection->getDocComment(),
            'methods' => collect($reflection->getMethods())->sort(),
            'methodSignatures' => collect($reflection->getMethods())
                ->mapWithKeys(fn (ReflectionMethod $method) => [
                    $method->getShortName() => Support\Methods\Signature::get($method),
                ]),
            'methodTraits' => collect($reflection->getMethods())
                ->mapWithKeys(fn (ReflectionMethod $method) => [
                    $method->getShortName() => Support\Traits\Discovery::getFromMethod($reflection, $method->getName()),
                ]),
            'schedule' => Commands\Schedule::getSchedule($instance),
        ]);
    }
}