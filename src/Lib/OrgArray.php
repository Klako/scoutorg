<?php

namespace Scoutorg\Lib;

class OrgArray implements \IteratorAggregate, \Countable
{
    protected $tree;

    public function __construct($tree)
    {
        $this->tree = $tree;
    }

    public function exists(string $source, $id): bool
    {
        return isset($this->tree[$source])
            && isset($this->tree[$source][$id]);
    }

    public function get(string $source, $id)
    {
        if (!isset($this->tree[$source])) {
            throw new \OutOfRangeException("Source '$source' doesn't exist");
        }
        if (!isset($this->tree[$source][$id])) {
            throw new \OutOfRangeException("Id '$id' in source '$source' doesn't exist");
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
            yield from $sourceArray;
        }
    }

    /**
     * @param $source
     * @return \Generator<int|string,OrgObject>
     */
    public function fromSource(string $source): \Generator
    {
        if (isset($this->tree[$source])) {
            yield from $this->tree[$source];
        }
    }
}
