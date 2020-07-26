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

    /**
     * @internal
     */
    public function __get($name)
    {
        if (\array_key_exists($name, $this->properties)) {
            $value = $this->properties[$name];
            if ($value instanceof IObjectPromise) {
                $link = $value->getObjectLink();
                if ($link === null) {
                    $value = null;
                    $metaInfos = [];
                } else {
                    $value = $link->getObject();
                    $metaInfos = $link->getMetaInfos();
                }
                $this->properties[$name] = $value;
                $this->properties["{$name}Info"] = $metaInfos;
            } elseif ($value instanceof IArrayPromise) {
                $value = $value->getArray();
                $this->properties[$name] = $value;
            }
            return $value;
        } else {
            throw new \Exception("Property $name is not defined");
        }
    }

    /**
     * @internal
     */
    public function __isset($name)
    {
        return isset($this->properties[$name]);
    }
}
