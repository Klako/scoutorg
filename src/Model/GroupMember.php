<?php

namespace Scouterna\Scoutorg\Model;

/**
 * A link between a group and a member.
 * @property-read string $startdate
 * @property-read ScoutGroup $group
 * @property-read Member $member
 * @property-read Arrays\GroupRoleArray<mixed,GroupRole> $roles
 * @package Scouterna\Scoutorg\Model
 */
class GroupMember extends OrgObject
{
    public function __construct(
        Uid $uid,
        string $startdate,
        IObjectPromise $group,
        IObjectPromise $member,
        IArrayPromise $roles
    ) {
        parent::__construct($uid);
        $this->setProperty('startdate', $startdate);
        $this->setObject('group', $group);
        $this->setObject('member', $member);
        $this->setArray('roles', $roles);
    }
}
