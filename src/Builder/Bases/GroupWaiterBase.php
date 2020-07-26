<?php

namespace Scouterna\Scoutorg\Builder\Bases;

class GroupWaiterBase extends ObjectBase
{
    private $waitingSince;

    public function __construct(string $waitingSince)
    {
        $this->waitingSince = $waitingSince;
    }

    public function getWaitingSince()
    {
        return $this->waitingSince;
    }
}
