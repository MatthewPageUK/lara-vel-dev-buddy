<?php

namespace MatthewPageUK\LaraVelDevBuddy\Http\Controllers;

use Illuminate\Support\Collection;
use MatthewPageUK\LaraVelDevBuddy\Modules\Configs;

class ConfigsController extends Controller
{
    public function index()
    {
        return Configs\Module::getView('index', [
            'title' => 'LVDB - Configs',
            'module' => Configs\Module::class,
            'configs' => Configs\Discovery::getAll(),
        ]);
    }

    public function show(string $config)
    {
        return Configs\Module::getView('view', [
            'title' => 'LVDB - Configs - ' . $config,
            'module' => Configs\Module::class,
            'config' => $config,
            'configs' => Configs\Discovery::getAll(),
            'values' => config($config),
            'flattened' => $this->flattenConfig(config($config)),
        ]);
    }


    private function flattenConfig(array $config, string $prefix = ''): Collection
    {
        $result = collect();

        foreach ($config as $key => $value) {
            $fullKey = $prefix ? $prefix . '.' . $key : $key;

            if (is_array($value)) {
                $result = $result->merge($this->flattenConfig($value, $fullKey));
            } else {
                $result->put($fullKey, $value);
            }
        }

        return $result;
    }

}