<?php

namespace MatthewPageUK\LaraVelDevBuddy\Modules\Enums;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionEnum;

class References
{
    /**
     * Get a collection of files that use a single enum.
     * @todo GPT generated, not sure it works well..
     */
    public static function get(ReflectionEnum $enum)
    {
        $enumName = $enum->getShortName();
        $directory = app_path();
        $classesUsingEnum = [];
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

        // gpt
        foreach ($files as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                $content = file_get_contents($file);
                if (strpos($content, $enumName) !== false) {
                    $tokens = token_get_all($content);
                    $namespace = '';
                    $class = '';
                    $foundClass = false;

                    for ($i = 0; $i < count($tokens); $i++) {
                        if ($tokens[$i][0] === T_NAMESPACE) {
                            $namespace = '';
                            for ($j = $i + 1; $j < count($tokens) && is_array($tokens[$j]); $j++) {
                                if ($tokens[$j][0] === T_STRING || $tokens[$j][0] === T_NS_SEPARATOR) {
                                    $namespace .= $tokens[$j][1];
                                } elseif ($tokens[$j][0] === T_WHITESPACE) {
                                    continue;
                                } else {
                                    break;
                                }
                            }
                        }

                        if ($tokens[$i][0] === T_CLASS) {
                            $class = '';
                            for ($j = $i + 1; $j < count($tokens) && is_array($tokens[$j]); $j++) {
                                if ($tokens[$j][0] === T_STRING) {
                                    $class = $tokens[$j][1];
                                    break;
                                }
                            }
                            $foundClass = true;
                        }

                        if ($foundClass && $tokens[$i][0] === T_STRING && $tokens[$i][1] === $enumName) {
                            $fullClassName = ($namespace ? $namespace . '\\' : '') . $class;
                            $classesUsingEnum[] = $file; //$fullClassName;
                            $foundClass = false;
                            break;
                        }
                    }
                }
            }
        }

        return array_unique($classesUsingEnum);

    }
}