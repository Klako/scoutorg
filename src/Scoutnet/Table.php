<?php

namespace Scoutorg\Scoutnet;

class Table
{
    private $array;

    public function __construct()
    {
        $this->array = [];
    }

    public function setBase($id, $base)
    {
        $this->array[$id]['base'] = $base;
    }

    public function hasBase($id)
    {
        return isset($this->array[$id]['base']);
    }

    public function getBase($id)
    {
        return $this->array[$id]['base'] ?? null;
    }

    public function initLink($id, $name){
        $this->array[$id]['links'][$name] = [];
    }

    public function setLink($id, $name, $link)
    {
        $this->array[$id]['links'][$name] = $link;
    }

    public function addLink($id, $name, $link)
    {
        $this->array[$id]['links'][$name][] = $link;
    }

    public function hasLink($id, $name)
    {
        return isset($this->array[$id]['links'][$name]);
    }

    public function getLink($id, $name)
    {
        return $this->array[$id]['links'][$name] ?? [];
    }
}
