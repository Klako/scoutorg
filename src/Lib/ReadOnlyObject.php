<?php

namespace Scoutorg\Lib;

class ReadOnlyObject
{
    /** @var array<string,mixed> */
    private $properties = null;

    protected function __construct()
    {
        $this->properties = [];
    }

    protected function setProperty($name, $value, $types = [])
    {
        if ($types){
            self::checkType($name, $value, $types);
        }
        $this->properties[$name] = $value;
    }

    protected function getProperty($name)
    {
        return $this->properties[$name] ?? null;
    }

    protected static function checkType($name, $value, $types)
    {
        foreach ($types as $type) {
            if (
                !($valueType = \gettype($value) === $type)
                && !($valueType = is_a($value, $type))
            ) {
                self::throwTypeError($name, $valueType, $types);
            }
        }
    }

    protected static function throwTypeError(&$name, &$actual, &$expected)
    {
        throw new \TypeError(
            "Value $name has the wrong type, expected [" . \join(', ', $expected) . "], got $actual"
        );
    }

    public function __get($name)
    {
        if (\array_key_exists($name, $this->properties)) {
            $value = $this->properties[$name];
            if ($value instanceof IObjectPromise) {
                $value = $value->getObject();
                self::checkType($name, $value, [OrgObject::class]);
                $this->properties[$name] = $value;
            } elseif ($value instanceof IArrayPromise) {
                $value = $value->getArray();
                self::checkType($name, $value, [OrgArray::class]);
                $this->properties[$name] = $value;
            }
            return $value;
        } else {
            throw new \Exception("Property $name is not defined");
        }
    }

    public function __isset($name)
    {
        return isset($this->properties[$name]);
    }
}
