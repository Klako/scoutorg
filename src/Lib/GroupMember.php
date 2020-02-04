<?php

namespace Scoutorg\Lib;

/**
 * A link between a group and a member.
 * @property-read string $startdate
 * @property-read ScoutGroup $group
 * @property-read Member $member
 * @property-read Arrays\GroupRoleArray<GroupRole> $roles
 * @package Scoutorg\Lib
 */
class GroupMember extends OrgObject
{
    public function __construct(string $source, $id, string $startdate, $group, $member, $roles)
    {
        parent::__construct($source, $id);
        $this->setProperty('startdate', $startdate);
        $this->setObject('group', $group, ScoutGroup::class);
        $this->setObject('member', $member, Member::class);
        $this->setArray('roles', $roles, Arrays\GroupRoleArray::class);
    }
}