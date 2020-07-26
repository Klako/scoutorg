<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Model\OrgArray;
use Scouterna\Scoutorg\Model\OrgObject;
use Scouterna\Scoutorg\Model\Uid;

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
    public function addObject(OrgObject $orgObject)
    {
        $uid = $orgObject->uid;
        [$source, $id] = [$uid->getSource(), $uid->getId()];
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
