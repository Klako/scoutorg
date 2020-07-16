<?php

namespace Scouterna\Scoutorg\Builder;

use Scouterna\Scoutorg\Model\Uid;

class EdgeUid extends Uid
{
    private $target;

    public function __construct(string $source, $id, Uid $target)
    {
        parent::__construct($source, $id);
        $this->target = $target;
    }

    public function getTarget()
    {
        return $this->target;
    }
}