<?php

namespace Scouterna\Scoutorg\Model;

class OrgArray implements \IteratorAggregate, \Countable, \ArrayAccess
{
    /**
     * Tree holding array of source which hold array of OrgObjects
     * @var OrgObject[][][]|string[][][]
     */
    protected $tree;

    public function __construct($tree)
    {
        $this->tree = $tree;
    }

    public function exists(Uid $uid): bool
    {
        [$source, $id] = [$uid->getSource(), $uid->getId()];
        return isset($this->tree[$source][$id]);
    }

    public function offsetExists($offset)
    {
        $offset = (string) $offset;
        $uid = Uid::deserialize($offset);
        return $uid ? $this->exists($uid) : false;
    }

    /**
     * Gets an OrgObject with the given uid
     */
    public function get(Uid $uid)
    {
        [$source, $id] = [$uid->getSource(), $uid->getId()];
        return $this->tree[$source][$id]['object'] ?? null;
    }

    public function offsetGet($offset)
    {
        $offset = (string) $offset;
        $uid = Uid::deserialize($offset);
        return $uid ? $this->get($uid) : null;
    }

    /**
     * Returns all sources that have
     * asserted the link to an OrgObject
     * @param Uid $uid 
     * @return string[]|false
     */
    public function sourcesOf(Uid $uid)
    {
        [$source, $id] = [$uid->getSource(), $uid->getId()];
        return $this->tree[$source][$id]['sources'] ?? false;
    }

    public function count(): int
    {
        $sum = 0;
        foreach ($this->tree as $sourceArray) {
            $sum += count($sourceArray);
        }
        return $sum;
    }

    public function getIterator()
    {
        foreach ($this->tree as $sourceArray) {
            foreach ($sourceArray as $objectElem) {
                $orgObject = $objectElem['object'];
                yield $orgObject->uid->serialize() => $orgObject;
            }
        }
    }

    /**
     * Returns a generator to iterate through all items
     * in a source.
     * @param $source
     * @return \Generator<string,OrgObject>
     */
    public function fromSource(string $source): \Generator
    {
        if (isset($this->tree[$source])) {
            foreach ($this->tree[$source] as $objectElem) {
                $orgObject = $objectElem['object'];
                yield $orgObject->uid->serialize() => $orgObject;
            }
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
