<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Model\OrgEdgeArray;
use Scouterna\Scoutorg\Model\OrgObject;

class OrgEdgeArrayBuilder
{
    private $tree;

    private $targetArray;

    public function __construct()
    {
        $this->tree = [];
        $this->targetArray = new OrgArrayBuilder();
    }

    /**
     * Adds an organizational object.
     * @param OrgObject $edgeObject
     * @param Uid $override
     * @return bool
     */
    public function addObject(OrgObject $edgeObject, OrgObject $targetObject)
    {
        $uid = $edgeObject->uid;
        [$source, $id] = [$uid->getSource(), $uid->getId()];
        if (isset($this->tree[$source][$id])) {
            return false;
        }
        if (!$this->targetArray->addObject($targetObject)) {
            return false;
        }
        $this->tree[$source][$id] = $edgeObject;
        return true;
    }

    public function build()
    {
        return new OrgEdgeArray($this->tree, $this->targetArray->build());
    }
}
