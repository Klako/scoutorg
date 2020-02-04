<?php

namespace Scoutorg\Builder;

class Helpers
{
    public static function checkType($name, $value, $types)
    {
        $foundType = false;
        foreach ($types as $type) {
            if (\gettype($value) === $type || is_a($value, $type)) {
                $foundType = true;
                break;
            }
        }
        if (!$foundType) {
            throw new \TypeError(
                "Value of '$name' has the wrong type, expected [" . \join(', ', $types) . '], got ' . \gettype($value)
            );
        }
    }
}
