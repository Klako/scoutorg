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
    public function addObject(OrgObject $orgObject, string $linkSource)
    {
        $uid = $orgObject->uid;
        [$source, $id] = [$uid->getSource(), $uid->getId()];
        if (isset($this->tree[$source][$id])) {
            $this->tree[$source][$id]['sources'][$linkSource] = $linkSource;
            return false;
        }
        $this->tree[$source][$id]['object'] = $orgObject;
        $this->tree[$source][$id]['sources'] = [$linkSource => $linkSource];
        return true;
    }

    /**
     * Removes an organizational object
     * @param \Scouterna\Scoutorg\Model\Uid $uid 
     * @return bool 
     */
    public function removeObject(Uid $uid){
        [$source, $id] = [$uid->getSource(), $uid->getId()];
        if (!isset($this->tree[$source][$id])){
            return false;
        }
        unset($this->tree[$source][$id]);
        return true;
    }

    public function build()
    {
        return new OrgArray($this->tree);
    }
}
