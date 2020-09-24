<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Model\OrgEdgeArray;
use Scouterna\Scoutorg\Model\OrgObject;
use Scouterna\Scoutorg\Model\Uid;

class OrgEdgeArrayBuilder
{
    private $tree;

    private $targetArray;

    private $edgeTargetLinks;

    public function __construct()
    {
        $this->tree = [];
        $this->targetArray = new OrgArrayBuilder();
        $this->edgeTargetLinks = [];
    }

    /**
     * Adds an organizational object.
     * @param OrgObject $edgeObject
     * @param Uid $override
     * @return bool
     */
    public function addObject(OrgObject $edgeObject, OrgObject $targetObject, string $linkSource)
    {
        $uid = $edgeObject->uid;
        [$source, $id] = [$uid->getSource(), $uid->getId()];
        if (isset($this->tree[$source][$id])) {
            $this->tree[$source][$id]['sources'][$linkSource] = $linkSource;
            return false;
        }
        if (!$this->targetArray->addObject($targetObject, $linkSource)) {
            return false;
        }
        $this->tree[$source][$id]['object'] = $edgeObject;
        $this->tree[$source][$id]['sources'] = [$linkSource => $linkSource];
        $this->edgeTargetLinks[$edgeObject->uid->serialize()] = $targetObject->uid->serialize();
        return true;
    }

    /**
     * Removes an organizational object
     * @param Uid $edgeUid 
     * @param Uid $targetUid 
     * @return bool 
     */
    public function removeObject(Uid $edgeUid) {
        [$source, $id] = [$edgeUid->getSource(), $edgeUid->getId()];
        if (!isset($this->tree[$source][$id])){
            return false;
        }
        unset($this->tree[$source][$id]);
        $targetUid = Uid::deserialize($this->edgeTargetLinks[$edgeUid->serialize()]);
        $this->targetArray->removeObject($targetUid);
        return true;
    }

    public function build()
    {
        return new OrgEdgeArray($this->tree, $this->targetArray->build());
    }
}
