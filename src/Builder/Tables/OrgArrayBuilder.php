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
     * @param string $linkSource
     * @return bool
     */
    public function addObject(OrgObject $orgObject, string $linkSource)
    {
        $uid = $orgObject->uid;
        if (isset($this->tree[$uid->serialized])) {
            $this->tree[$uid->serialized]['sources'][$linkSource] = $linkSource;
            return false;
        }
        $this->tree[$uid->serialized] = [
            'object' => $orgObject,
            'sources' => [$linkSource => $linkSource]
        ];
        return true;
    }

    /**
     * Removes an organizational object
     * @param \Scouterna\Scoutorg\Model\Uid $uid 
     * @return bool 
     */
    public function removeObject(Uid $uid){
        if (!isset($this->tree[$uid->serialized])){
            return false;
        }
        unset($this->tree[$uid->serialized]);
        return true;
    }

    public function build()
    {
        return new OrgArray($this->tree);
    }
}
