<?php

namespace MatthewPageUK\LaraVelDevBuddy\Http\Controllers;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use MatthewPageUK\LaraVelDevBuddy\Modules\Factories;
use MatthewPageUK\LaraVelDevBuddy\Modules;
use MatthewPageUK\LaraVelDevBuddy\Support;
use ReflectionClass;
use ReflectionMethod;

class FactoriesController extends Controller
{
    public function index()
    {
        //dd(Factories\Discovery::getAll());
        return Factories\Module::getView('index', [
            'title' => 'LVDB - Factories',
            'module' => Factories\Module::class,
            'factories' => Factories\Discovery::getAll(),
        ]);
    }

    public function show($factory)
    {
        if (! Factories\Validator::isFactory($factory)) {
            abort(404, 'This is not a factory');
        }

        $reflection = Support\Classes\Reflection::make($factory);
        $instance = new $factory;

        $output = collect($instance->definition())
            ->mapWithKeys(fn ($value, $key) => [
                $key => ($value instanceof Factory) ? (new ReflectionClass($value))->getName() : $value,
            ])
            ->mapWithKeys(fn ($value, $key) => [
                $key => ($value instanceof Carbon || $value instanceof DateTime) ? $value->format('Y-m-d h:m:s') : $value,
            ])
            ->mapWithKeys(fn ($value, $key) => [
                $key => is_bool($value) ? ($value ? 'true' : 'false') : $value,
            ]);

        //dd($output);

        return Factories\Module::getView('view', [
            'title' => 'LVDB - Factories - ' . $reflection->getShortName(),
            'module' => Factories\Module::class,
            'factories' => Factories\Discovery::getAll(),
            'reflection' => $reflection,
            'file' => Support\Files\Analysis::getFileInfo($reflection->getFileName()),
            'instance' => $instance,
            'comment' => $reflection->getDocComment(),
            'output' => $output,
            'model' => (object) [
                'class' => $this->inferModelFromFactory($instance),
                'url' => Modules\Models\Module::getRoute('show', $this->inferModelFromFactory($instance)),
            ],
            // 'methods' => collect($reflection->getMethods())->sort(),
            // 'methodSignatures' => collect($reflection->getMethods())
            //     ->mapWithKeys(fn (ReflectionMethod $method) => [
            //         $method->getShortName() => Support\Methods\Signature::get($method),
            //     ]),
            // 'methodTraits' => collect($reflection->getMethods())
            //     ->mapWithKeys(fn (ReflectionMethod $method) => [
            //         $method->getShortName() => Support\Traits\Discovery::getFromMethod($reflection, $method->getName()),
            //     ]),
        ]);
    }

    function getModelFromFactory(Factory $factory)
    {
        $reflector = new ReflectionClass($factory);
        $property = $reflector->getProperty('model');
        $property->setAccessible(true);
        return $property->getValue($factory);
    }

    function inferModelFromFactory(Factory $factory)
    {
        // Get the full class name including namespace
        $factoryClass = get_class($factory);

        // Extract the base name of the factory class
        $baseName = class_basename($factoryClass);

        // Remove 'Factory' from the end of the class name
        $modelBaseName = Str::replaceLast('Factory', '', $baseName);

        // Assume the model is in the App\Models namespace
        $modelClass = "App\\Models\\$modelBaseName";

        // Check if the model class exists
        if (class_exists($modelClass)) {
            return $modelClass;
        }

        // Return null if no corresponding model class is found
        return null;
    }
}