<?php

namespace MatthewPageUK\LaraVelDevBuddy\Http\Controllers;

use Illuminate\Http\Request;
use MatthewPageUK\LaraVelDevBuddy\Modules\Enums;
use MatthewPageUK\LaraVelDevBuddy\Support;
use ReflectionMethod;

class EnumsController extends Controller
{
    public function index()
    {
        return Enums\Module::getView('index', [
            'title' => 'LVDB - Enums',
            'module' => Enums\Module::class,
            'enums' => Enums\Discovery::getAll(),
            'enumTraits' => Enums\Traits::getAll(),
            'enumInterfaces' => Enums\Interfaces::getAll(),
        ]);
    }

    public function show($enum)
    {
        try {
            $reflection = new \ReflectionEnum($enum);
        } catch (\Exception $e) {
            abort(404, $e->getMessage());
        }

        return Enums\Module::getView('view', [
            'title' => 'LVDB - Enum - ' . $reflection->getShortName(),
            'module' => Enums\Module::class,
            'enums' => Enums\Discovery::getAll(),
            'enumTraits' => Enums\Traits::getAll(),
            'enumInterfaces' => Enums\Interfaces::getAll(),
            'reflection' => $reflection,
            'file' => Support\Files\Analysis::getFileInfo($reflection->getFileName()),
            'enumClass' => $enum,
            'traits' => Enums\Traits::get($reflection),
            'cases' => $enum::cases(),
            'methods' => collect($reflection->getMethods())
                ->map(fn (ReflectionMethod $method) => [
                    'method' => $method,
                    'signature' => Support\Methods\Signature::get($method),
                    'trait' => Support\Traits\Discovery::getFromMethod($reflection, $method->getName()),
                    'overridden' => false,
                ]),
            'references' => Enums\References::get($reflection),
            'interfaces' => Enums\Interfaces::get($reflection),
            'getters' => Enums\Getters::get($reflection),
            'comment' => $reflection->getDocComment(),
        ]);
    }

    // Testing make enum
    public function getCode(Request $request)
    {
        return view('lvdb::modules.enums.code', [
            'namespace' => $request->input('namespace'),
            'name' => $request->input('name'),
            'returnType' => $request->input('returnType'),
            'cases' => $request->input('cases'),
        ]);
    }
}