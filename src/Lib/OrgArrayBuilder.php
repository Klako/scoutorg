<?php

namespace Scoutorg\Lib;

class OrgArrayBuilder
{
    private $tree;

    public function __construct()
    {
        $this->tree = [];
    }

    /**
     * Adds an organizational object.
     * @param OrgObject $orgObject
     */
    public function addObject($orgObject)
    {
        assert(
            $orgObject instanceof OrgObject,
            new \TypeError('Type error, expected ' . OrgObject::class
                . ', got ' . (\gettype($orgObject) === 'object' ? \get_class($orgObject) : \gettype($orgObject)))
        );
        if (!isset($this->tree[$orgObject->source])) {
            $this->tree[$orgObject->source] = [];
        }
        $this->tree[$orgObject->source][$orgObject->id] = $orgObject;
    }

    public function buildArray()
    {
        return new OrgArray($this->tree);
    }
}
