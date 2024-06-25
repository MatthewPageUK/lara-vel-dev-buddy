<?php

namespace MatthewPageUK\LaraVelDevBuddy\Support;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Carbon\Carbon;
use MatthewPageUK\LaraVelDevBuddy\Modules\Migrations\Discovery;

class MigrationDiscovery
{
    public function getMigrationFiles(): Collection
    {
        return collect(
            File::allFiles(database_path('migrations'))
        );
    }

    public function getMigrationsFromTableName(string $table)
    {
        return Discovery::getAll()
            ->filter(function ($migration) use ($table) {
                $contents = file_get_contents($migration->fullpath);

                return str_contains($contents, 'Schema::create(\''.$table.'\'')
                    || str_contains($contents, 'Schema::table(\''.$table.'\'');
            });
    }
}