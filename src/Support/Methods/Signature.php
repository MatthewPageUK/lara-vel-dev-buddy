<?php

namespace MatthewPageUK\LaraVelDevBuddy\Support\Methods;

use ReflectionMethod;

class Signature
{
    public static function get(ReflectionMethod $method) {

        // gpt
        $signature = $method->getName() . '(';

        $parameters = $method->getParameters();
        $paramStrings = [];
        foreach ($parameters as $parameter) {
            $paramString = '';

            // Get type
            if ($parameter->hasType()) {
                $paramString .= $parameter->getType() . ' ';
            }

            // Get parameter name
            $paramString .= '$' . $parameter->getName();

            // Get default value if available
            if ($parameter->isOptional()) {
                $paramString .= ' = ' . var_export($parameter->getDefaultValue(), true);
            }

            $paramStrings[] = $paramString;
        }

        $signature .= implode(', ', $paramStrings);
        $signature .= ')';

        return $signature;
    }
}