<?php

namespace Scouterna\Scoutorg\Builder\Bases;

use Scouterna\Scoutorg\Model\Arrays\TroopMemberArray;

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
