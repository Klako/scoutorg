<?php

namespace Scouterna\Scoutorg\Builder\Bases;

use Scouterna\Scoutorg\Lib\Arrays\GroupWaiterArray;

class GroupWaiterBase extends ObjectBase
{
    public const ARRAY_TYPE = GroupWaiterArray::class;

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
