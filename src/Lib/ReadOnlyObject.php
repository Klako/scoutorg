<?php

namespace Scoutorg\Lib;

class ReadOnlyObject
{
    /** @var Property[] */
    private $properties = null;

    protected function __construct()
    {
        $this->properties = [];
        
    }

    protected final function setProperty(string $name, array $types, $value)
    {
        assert(
            \in_array($valueType = \gettype($value), $types)
                || \in_array($valueType = \get_class($value), $types)
                || \is_callable($value),
            new \TypeError("Error when setting property '$name', expected [$types], got $valueType")
        ); // Should not run in production.
        $this->properties[$name] = new Property($types, $value);
    }

    public final function __get($name)
    {
        if (\array_key_exists($name, $this->properties)) {
            if (is_callable($this->properties[$name]->value)) {
                $func = $this->properties[$name]->value;
                $value = $func($this);
                assert(
                    \in_array($valueType = \gettype($value), $this->properties[$name]->types),
                    new \TypeError("Error when setting property '$name', expected [{$this->properties[$name]->types}], got $valueType")
                );
                $this->properties[$name] = $value;
            }
            return $this->properties[$name];
        }
    }
}