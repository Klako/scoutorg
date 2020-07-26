<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Model\OrgArray;
use Scouterna\Scoutorg\Model\OrgObject;
use Scouterna\Scoutorg\Model\Uid;

class OrgArrayBuilder
{
    private $tree;

    private $sources;

    public function __construct()
    {
        $this->tree = [];
        $this->sources = [];
    }

    /**
     * Adds an organizational object.
     * @param OrgObject $orgObject
     * @param Uid $override
     * @return bool
     */
    public function addObject(OrgObject $orgObject, string $source)
    {
        $uid = $orgObject->uid;
        [$source, $id] = [$uid->getSource(), $uid->getId()];
        if (isset($this->tree[$source][$id])) {
            $this->tree[$source][$id]['sources'][$source] = $source;
            return false;
        }
        $this->tree[$source][$id]['object'] = $orgObject;
        $this->tree[$source][$id]['sources'] = [$source => $source];
        return true;
    }

    public function build()
    {
        return new OrgArray($this->tree);
    }
}
