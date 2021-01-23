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
        if (isset($this->tree[$uid->serialized])) {
            $this->tree[$uid->serialized]['sources'][$linkSource] = $linkSource;
            return false;
        }
        if (!$this->targetArray->addObject($targetObject, $linkSource)) {
            return false;
        }
        $this->tree[$uid->serialized]['object'] = $edgeObject;
        $this->tree[$uid->serialized]['sources'] = [$linkSource => $linkSource];
        $this->edgeTargetLinks[$edgeObject->uid->serialize()] = $targetObject->uid;
        return true;
    }

    /**
     * Removes an organizational object
     * @param Uid $edgeUid 
     * @param Uid $targetUid 
     * @return bool 
     */
    public function removeObject(Uid $edgeUid) {
        if (!isset($this->tree[$edgeUid->serialized])){
            return false;
        }
        unset($this->tree[$edgeUid->serialized]);
        $targetUid = $this->edgeTargetLinks[$edgeUid->serialized];
        $this->targetArray->removeObject($targetUid);
        return true;
    }

    public function build()
    {
        return new OrgEdgeArray($this->tree, $this->targetArray->build());
    }
}
