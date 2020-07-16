<?php

namespace Scouterna\Scoutorg\Builder\Bases;

use Scouterna\Scoutorg\Model\Arrays\GroupMemberArray;

class GroupMemberBase extends ObjectBase
{
    public const ARRAY_TYPE = GroupMemberArray::class;

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
