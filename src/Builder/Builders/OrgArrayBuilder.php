<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib\OrgArray;
use Scoutorg\Lib\OrgObject;

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
     * @param array $index
     * @return bool
     */
    public function addObject($orgObject, $index = null)
    {
        assert(
            $orgObject instanceof OrgObject,
            new \TypeError('Type error, expected ' . OrgObject::class
                . ', got ' . (\gettype($orgObject) === 'object' ? \get_class($orgObject) : \gettype($orgObject)))
        );
        if ($index) {
            $source = $index['source'];
            $id = $index['id'];
        } else {
            $source = $orgObject->source;
            $id = $orgObject->id;
        }
        if (!isset($this->tree[$source])) {
            $this->tree[$source] = [];
        }
        if (isset($this->tree[$source][$id])) {
            return false;
        }
        $this->tree[$source][$id] = $orgObject;
        return true;
    }

    public function build()
    {
        return new OrgArray($this->tree);
    }
}