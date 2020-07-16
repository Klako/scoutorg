<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Model\OrgObject;
use Scouterna\Scoutorg\Builder\Uid;

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
     * @param Uid $override
     * @return bool
     */
    public function addObject(OrgObject $orgObject, Uid $override = null)
    {
        assert(
            $orgObject instanceof OrgObject,
            new \TypeError('Type error, expected ' . OrgObject::class
                . ', got ' . (\gettype($orgObject) === 'object' ? \get_class($orgObject) : \gettype($orgObject)))
        );
        if ($override) {
            $source = $override->getSource();
            $id = $override->getId();
        } else {
            $source = $orgObject->source;
            $id = $orgObject->id;
        }
        if (isset($this->tree[$source][$id])) {
            return false;
        }
        $this->tree[$source][$id] = $orgObject;
        return true;
    }

    public function build($type)
    {
        return new $type($this->tree);
    }
}
