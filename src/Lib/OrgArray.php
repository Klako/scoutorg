<?php

namespace Scoutorg\Lib;

use BadMethodCallException;
use OutOfRangeException;

class OrgArray implements \IteratorAggregate, \Countable
{
    protected $tree;

    public function __construct($tree)
    {
        $this->tree = $tree;
    }

    public function exists($source, $index)
    {
        return isset($this->tree[$source])
            && isset($this->tree[$source][$index]);
    }

    public function get($source, $index)
    {
        if (!isset($this->tree[$source])) {
            throw new OutOfRangeException("Source '$source' doesn't exist");
        }
        if (!isset($this->tree[$source][$index])) {
            throw new OutOfRangeException("Index '$index' in source '$source' doesn't exist");
        }
        return $this->tree[$source][$index];
    }

    public function count()
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

    public function canInsert($orgObject)
    {
        return false;
    }

    public function insert($orgObject)
    {
        throw new \BadMethodCallException('Not implemented');
    }

    public function canDelete($source, $index)
    {
        return false;
    }

    public function delete($source, $index)
    {
        throw new \BadMethodCallException('Not implemented');
    }
}
