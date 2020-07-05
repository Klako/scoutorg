<?php

namespace Scouterna\Scoutorg\Scoutnet;

use Scouterna\Scoutorg\Builder\Bases\ObjectBase;
use Scouterna\Scoutorg\Builder\Uid;

class Table
{
    private $array;

    public function __construct()
    {
        $this->array = [];
    }

    /**
     * Sets the base object of an org object.
     * @param int|string $id 
     * @param ObjectBase $base 
     * @return void 
     */
    public function setBase($id, $base)
    {
        $this->array[$id]['base'] = $base;
    }

    /**
     * Checks if org object has a base object.
     * @param int|string $id 
     * @return bool 
     */
    public function hasBase($id)
    {
        return isset($this->array[$id]['base']);
    }

    /**
     * Gets the base object of an org object.
     * @param int|string $id 
     * @return ObjectBase 
     */
    public function getBase($id)
    {
        return $this->array[$id]['base'] ?? null;
    }

    /**
     * Sets a link to the id of an org object.
     * @param int|string $id 
     * @param string $name 
     * @param Uid $link 
     * @return void 
     */
    public function setLink($id, $name, $link)
    {
        $this->array[$id]['link'][$name] = $link;
    }

    /**
     * Checks if a link exists for the given link name.
     * @param int|string $id 
     * @param string $name 
     * @return bool 
     */
    public function hasLink($id, $name)
    {
        return isset($this->array[$id]['link'][$name]);
    }

    /**
     * Gets a link object or array of the given link name.
     * @param int|string $id 
     * @param string $name 
     * @param Uid $link 
     * @return Uid
     */
    public function getLink($id, $name)
    {
        return $this->array[$id]['link'][$name] ?? null;
    }

    /**
     * Adds a link with the id of an org object.
     * @param int|string $id 
     * @param string $name 
     * @param Uid $link 
     * @return void 
     */
    public function addLink($id, $name, $link)
    {
        $this->array[$id]['links'][$name][] = $link;
    }

    /**
     * Sets a link list to empty.
     * @param int|string $id 
     * @param string $name 
     * @return void 
     */
    public function initLinks($id, $name)
    {
        $this->array[$id]['links'][$name] = [];
    }

    public function hasLinks($id, $name)
    {
        return isset($this->array[$id]['links'][$name]);
    }

    /**
     * Gets a link object or array of the given link name.
     * @param int|string $id 
     * @param string $name 
     * @return Uid[]
     */
    public function getLinks($id, $name)
    {
        return $this->array[$id]['links'][$name] ?? [];
    }

    private function linkIterator($id, $name)
    {
        foreach ($this->array[$id]['links'][$name] as $sourceUids) {
            yield from $sourceUids;
        }
    }
}
