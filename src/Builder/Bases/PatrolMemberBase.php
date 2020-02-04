<?php

namespace Scoutorg\Builder\Bases;

use Scoutorg\Builder\Uid;
use Scoutorg\Lib\Arrays\PatrolMemberArray;

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
