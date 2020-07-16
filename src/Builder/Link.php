<?php

namespace Scouterna\Scoutorg\Builder;

use Scouterna\Scoutorg\Model\Uid;

final class Link
{
    private $targetUid;
    private $edgeUid;

    public function __construct(Uid $targetUid, ?Uid $edgeUid = null)
    {
        $this->targetUid = $targetUid;
        $this->edgeUid = $edgeUid;
    }

    public function getTarget()
    {
        return $this->targetUid;
    }

    public function getEdge()
    {
        return $this->edgeUid;
    }
}
