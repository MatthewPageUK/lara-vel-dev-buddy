<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Migrations;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use MatthewPageUK\LaraVelDevBuddy\Support\Files;
use SplFileInfo;

/**
 * Migration discovery helpers.
 */
class Discovery
{
    /**
     * Get a collection of all Migrations in the app.
     */
    public static function getAll()
    {
        $migrationBatches = DB::table('migrations')->get();

        return Files\Discovery::getAll('database')
            ->filter(fn (SplFileInfo $file): bool => Validator::isMigration($file))
            ->map(function (SplFileInfo $file) use ($migrationBatches): object {
                return (object) [
                    'filename' => $file->getFilename(),
                    'path' => $file->getRelativePathName(),
                    'fullpath' => $file->getRealPath(),
                    'date' => Discovery::getCarbonDateFromFile($file),
                    'name' => Discovery::getHumanNameFromFile($file),
                    'batch' => Discovery::getBatchFromFile($file, $migrationBatches),
                    'table' => Discovery::getTableNameFromFile($file),
                ];
            })
            ->sortByDesc('date');
    }

    protected static function getHumanNameFromFile(SplFileInfo $file): string
    {
        return Str::of($file->getFilename())
            ->substr(18)
            ->replace('_', ' ')
            ->replace('.php', '')
            ->ucfirst();
    }

    protected static function getCarbonDateFromFile(SplFileInfo $file): ?Carbon
    {
        try {
            return Carbon::createFromFormat('Y_m_d_Gis', Str::of($file->getFilename())->substr(0, 17));
        } catch (\Exception $e) {
            return null;
        }
    }

    protected static function getBatchFromFile(SplFileInfo $file, Collection $migrationBatches): ?int
    {
        return $migrationBatches
            ->where('migration', str_replace('.php', '', $file->getFilename()))
            ->value('batch');
    }

    protected static function getTableNameFromFile(SplFileInfo $file): string
    {
        // Read the file content
        $content = file_get_contents($file->getRealPath());

        // Define a regex pattern to match the table name
        $pattern = '/Schema::(create|table)\s*\(\s*[\'"]([^\'"]+)[\'"]\s*,/';

        // Search for the pattern in the content
        if (preg_match($pattern, $content, $matches)) {
            // The table name is in the second capture group
            return $matches[2];
        }

        // Return null if no table name is found
        return 'unkown table';
    }
}