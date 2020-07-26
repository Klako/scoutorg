<?php

namespace Scouterna\Scoutorg\Model;

class OrgArray implements \IteratorAggregate, \Countable
{
    /**
     * Tree holding array of source which hold array of OrgObjects
     * @var OrgObject[][]
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

    public function get(Uid $uid)
    {
        [$source, $id] = [$uid->getSource(), $uid->getId()];
        if (!isset($this->tree[$source])) {
            return null;
        }
        if (!isset($this->tree[$source][$id])) {
            return null;
        }
        return $this->tree[$source][$id];
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
            foreach ($sourceArray as $orgObject) {
                yield $orgObject->uid->serialize() => $orgObject;
            }
        }
    }

    /**
     * @param $source
     * @return \Generator<int|string,OrgObject>
     */
    public function fromSource(string $source): \Generator
    {
        if (isset($this->tree[$source])) {
            foreach ($this->tree[$source] as $orgObject){
                yield $orgObject->uid->serialize() => $orgObject;
            }
        }
    }
}
