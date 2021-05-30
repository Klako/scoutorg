<?php

namespace Scouterna\Scoutorg\Model;

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
        if ($types) {
            Helper::checkType($name, $value, $types);
        }
        $this->properties[$name] = $value;
    }

    protected function getProperty($name)
    {
        if (!\array_key_exists($name, $this->properties)) {
            throw new \Exception("Property $name is not defined");
        }
        return $this->properties[$name];
    }

    /**
     * @internal
     */
    public function __get($name)
    {
        return $this->getProperty($name);
    }

    /**
     * @internal
     */
    public function __isset($name)
    {
        return isset($this->properties[$name]);
    }
}
