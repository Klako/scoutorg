<?php

namespace Scoutorg\Builder;

class Helpers
{
    public static function checkType($name, $value, $types)
    {
        foreach ($types as $type) {
            if (
                !($valueType = \gettype($value) === $type)
                && !($valueType = is_a($value, $type))
            ) {
                throw new \TypeError(
                    "Value $name has the wrong type, expected [" . \join(', ', $types) . "], got $valueType"
                );
            }
        }
    }
}
