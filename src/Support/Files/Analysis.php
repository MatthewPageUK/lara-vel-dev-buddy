<?php

namespace MatthewPageUK\LaraVelDevBuddy\Support\Files;

use stdClass;

class Analysis
{
    /**
     * Get file information
     *
     * @param string $filename
     * @return stdClass {name: string, lines: array<string>, contents: string, lineCount: int, size: string, longestLine: int, variables: array<string>}
     */
    public static function getFileInfo(string $filename): stdClass
    {
        $file = (object)[];

        $file->name = $filename;
        $file->lines = file($file->name);
        $file->contents = file_get_contents($file->name);
        $file->lineCount = count($file->lines);
        // $file->size = Number::fileSize(filesize($file->name), 2);
        $file->size = filesize($file->name);
        $file->longestLine = max(array_map('strlen', $file->lines));

        // Chat GPT
        $tokens = token_get_all($file->contents);
        $variables = [];
        foreach ($tokens as $token) {
            if (is_array($token) && $token[0] == T_VARIABLE) {
                $variables[] = $token[1];
            }
        }
        $variables = array_unique($variables);
        sort($variables);

        $file->variables = collect($variables);

        return $file;

    }
}