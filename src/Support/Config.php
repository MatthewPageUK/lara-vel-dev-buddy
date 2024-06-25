<?php

namespace MatthewPageUK\LaraVelDevBuddy\Support;

use Illuminate\Support\Collection;
use MatthewPageUK\LaraVelDevBuddy\Modules;

class Config
{
    public static function getModules(): Collection
    {
        return collect([
            Modules\Commands\Module::class,
            Modules\Controllers\Module::class,
            Modules\Enums\Module::class,
            Modules\Middleware\Module::class,
            Modules\Models\Module::class,
            Modules\Routes\Module::class,
            Modules\Configs\Module::class,
            Modules\Factories\Module::class,
            Modules\Migrations\Module::class,
        ]);
    }
}