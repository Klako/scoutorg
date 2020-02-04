<?php

namespace Scoutorg\Builder\Bases;

use Scoutorg\Lib\Arrays\GroupMemberArray;

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
