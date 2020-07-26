<?php

namespace Scouterna\Scoutorg\Model;

class OrgArray implements \IteratorAggregate, \Countable
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
        return isset($this->tree[$source])
            && isset($this->tree[$source][$id]);
    }

    /**
     * Gets an OrgObject with the given uid
     */
    public function get(Uid $uid)
    {
        [$source, $id] = [$uid->getSource(), $uid->getId()];
        if (!isset($this->tree[$source])) {
            return null;
        }
        if (!isset($this->tree[$source][$id])) {
            return null;
        }
        return $this->tree[$source][$id]['object'];
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
        if (!isset($this->tree[$source])) {
            return false;
        }
        if (!isset($this->tree[$source][$id])) {
            return false;
        }
        return $this->tree[$source][$id]['sources'];
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
     * @return \Generator<int|string,OrgObject>
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
}
