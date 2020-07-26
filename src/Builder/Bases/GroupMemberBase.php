<?php

namespace Scouterna\Scoutorg\Builder\Bases;

class GroupMemberBase extends ObjectBase
{
    private $startdate;

    public function __construct(string $startdate)
    {
        $this->startdate = $startdate;
    }

    public function getStartdate()
    {
        return $this->startdate;
    }
}
