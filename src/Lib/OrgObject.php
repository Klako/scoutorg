<?php

namespace Scoutorg\Lib;

/**
 * A generic organizational object.
 * @property-read string $source
 * @property-read int|string $id
 */
class OrgObject
{
    /** @var Property[] */
    private $properties = null;

    protected function __construct($source, $id)
    {
        $this->properties = [];
        $this->setProperty('source', ['string'], $source);
        $this->setProperty('id', ['int', 'string'], $id);
    }

    final protected function setProperty(string $name, array $types, $value)
    {
        assert(
            \in_array($valueType = \gettype($value), $types)
                || \in_array(
                    $valueType = \get_class($value),
                    \array_merge($types, [\Closure::class])
                ),
            new \TypeError("Error when setting property '$name', expected [$types], got $valueType")
        ); // Should not run in production.
        $this->properties[$name] = new Property($types, $value);
    }

    final public function __get($name)
    {
        if (\array_key_exists($name, $this->properties)) {
            if ($this->properties[$name]->value instanceof \Closure) {
                $value = $this->properties[$name]->value($this);
                assert(
                    \in_array($valueType = \gettype($value), $this->properties[$name]->types),
                    new \TypeError("Error when setting property '$name', expected [{$this->properties[$name]->types}], got $valueType")
                );
                $this->properties[$name] = $value;
            }
            return $this->properties[$name];
        }
    }

    public function canUpdate($property)
    {
        return false;
    }

    public function update($property, $value)
    {
        throw new \BadMethodCallException('Not implemented');
    }
}
