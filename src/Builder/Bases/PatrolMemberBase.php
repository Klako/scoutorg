<?php

namespace Scouterna\Scoutorg\Builder\Bases;

use Scouterna\Scoutorg\Lib\Arrays\PatrolMemberArray;

/**
 * A configuration for building a patrol member.
 */
class PatrolMemberBase extends ObjectBase
{
    public const ARRAY_TYPE = PatrolMemberArray::class;

    public function __construct()
    {
    }
}
