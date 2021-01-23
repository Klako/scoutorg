<?php

namespace Scouterna\Scoutorg\Model;

class OrgArray implements \IteratorAggregate, \Countable, \ArrayAccess
{
    /**
     * Array holding all org objects and their meta info.
     * @var OrgObject[][]|string[][]
     */
    protected $array;

    public function __construct($array)
    {
        $this->array = $array;
    }

    public function exists(Uid $uid): bool
    {
        return $this->offsetExists($uid->serialized);
    }

    public function offsetExists($offset)
    {
        return isset($this->array[$offset]);
    }

    /**
     * Gets an OrgObject with the given uid
     */
    public function get(Uid $uid)
    {
        return $this->offsetGet($uid->serialized);
    }

    public function offsetGet($offset)
    {
        return $this->array[$offset]['object'] ?? null;
    }

    /**
     * Returns all sources that have
     * asserted the link to an OrgObject
     * @param Uid $uid 
     * @return string[]|false
     */
    public function sourcesOf(Uid $uid)
    {
        return $this->array[$uid->serialized]['sources'] ?? false;
    }

    public function count(): int
    {
        return count($this->array);
    }

    public function getIterator()
    {
        foreach ($this->array as $uid => $objectElement) {
            yield $uid => $objectElement['object'];
        }
    }

    public function offsetSet($offset, $value)
    {
        return;
    }

    public function offsetUnset($offset)
    {
        return;
    }
}
