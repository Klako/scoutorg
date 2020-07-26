<?php

namespace Scouterna\Scoutorg\Model\Arrays;

use Scouterna\Scoutorg\Model;

/**
 * @method Model\GroupMember get(Model\Uid|null $uid)
 * @method \Generator<string,Model\GroupMember> fromSource(string $source)
 * @method MemberArray targets()
 */
class GroupMemberArray extends Model\OrgEdgeArray
{
}