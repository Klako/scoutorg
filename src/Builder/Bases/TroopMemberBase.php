<?php

namespace Scoutorg\Builder\Bases;

use Scoutorg\Builder\Uid;
use Scoutorg\Lib\Arrays\TroopMemberArray;

/**
 * A configuration for building a troop member.
 */
class TroopMemberBase extends ObjectBase
{
    public const ARRAY_TYPE = TroopMemberArray::class;

    public function __construct()
    {
    }
}
