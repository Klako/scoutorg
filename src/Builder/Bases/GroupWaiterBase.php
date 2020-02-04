<?php

namespace Scoutorg\Builder\Bases;

use Scoutorg\Lib\Arrays\GroupWaiterArray;

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
