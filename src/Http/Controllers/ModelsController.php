<?php

namespace MatthewPageUK\LaraVelDevBuddy\Http\Controllers;

use ErrorException;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use MatthewPageUK\LaraVelDevBuddy\Support\MigrationDiscovery;
use MatthewPageUK\LaraVelDevBuddy\Modules\Models;
use MatthewPageUK\LaraVelDevBuddy\Support;
use ReflectionClass;
use ReflectionMethod;

class ModelsController extends Controller
{
    public function index()
    {
        return Models\Module::getView('index', [
            'module' => Models\Module::class,
            'models' => Models\Discovery::getAll(),
            'title' => 'LVDB - Models',
        ]);
    }

    public function show($model)
    {
        $class = str_replace('/', '\\', $model);
        if (class_exists($class)) {
            $reflection = new \ReflectionClass($class);
            $object = new $class;
        }

        $traits = $reflection->getTraits();
        ksort($traits);

        $relationships = [];

        foreach((new ReflectionClass($object))->getMethods(ReflectionMethod::IS_PUBLIC) as $method)
        {
            if ($method->class != get_class($object) ||
                !empty($method->getParameters()) ||
                $method->getName() == __FUNCTION__) {
                continue;
            }

            try {
                $return = $method->invoke($object);

                if ($return instanceof Relation) {
                    $relationships[$method->getName()] = [
                        'type' => (new ReflectionClass($return))->getShortName(),
                        'model' => (new ReflectionClass($return->getRelated()))->getName(),
                        'method' => $method->getName(),
                    ];
                }
            } catch(ErrorException $e) {}
        }

        $relationships = collect($relationships);
        //dd($relationships);

        // dd($reflection->getConstants());
        // dd($reflection->getDocComment());

        // dd(Schema::getColumnListing($object->getTable()));

        $fields = collect(Schema::getColumnListing($object->getTable()))
            ->map(function ($field) use ($object) {
                return [
                    'name' => $field,
                    'type' => Schema::getColumnType($object->getTable(), $field),
                ];
            });

        $fields = DB::select('show columns from ' . $object->getTable());

        //dd($fields);

        return Models\Module::getView('view', [
            'models' => Models\Discovery::getAll(),
            'module' => Models\Module::class,
            'title' => 'LVDB - Models - ' . $reflection->getShortName(),
            'reflection' => $reflection,
            'file' => Support\Files\Analysis::getFileInfo($reflection->getFileName()),
            'comment' => $reflection->getDocComment(),
            'name' => $reflection->getShortName(),
            'namespace' => $reflection->getNamespaceName(),
            'parent' => $reflection->getParentClass(),
            'traits' => $traits,
            'table' => $object->getTable(),
            'primary_key' => $object->getKeyName(),
            'primary_key_type' => $object->getKeyType(),
            'incrementing' => $object->getIncrementing(),
            'fields' => $fields,
            'methods' => collect($reflection->getMethods())->filter(fn ($method) => $method->class !== 'Illuminate\Database\Eloquent\Model'),
            'scopes' => collect($reflection->getMethods())->filter(fn ($method) => str_starts_with($method->name, 'scope')),
            'properties' => collect($reflection->getProperties()),
            'fillables' => collect($object->getFillable())->sort(),
            'casts' => $object->getCasts(),
            'migrations' => app(MigrationDiscovery::class)->getMigrationsFromTableName($object->getTable()),
            'relationships' => $relationships,
        ]);
    }
}