<?php

namespace Scouterna\Scoutorg\Model;

class OrgEdgeArray extends OrgArray
{
    /**
     * Array that holds same structure as normal array
     * but with target objects instead of edge objects.
     * @var OrgArray
     */
    protected $targetArray;

    public function __construct(array $edgetree, OrgArray $targetArray)
    {
        parent::__construct($edgetree);
        $this->targetTree = $targetArray;
    }

    public function targets()
    {
        return $this->targetArray;
    }
}
