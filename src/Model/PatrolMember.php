<?php

/**
 * Contains PatrolMember class.
 */

namespace Scouterna\Scoutorg\Model;

/**
 * A link between a Patrol and a member,
 * containing information about the relationship.
 * @property-read Patrol $patrol
 * @property-read Member $member
 * @property-read Arrays\PatrolRoleArray<mixed,PatrolRole> $roles
 */
class PatrolMember extends OrgObject
{
    /**
     * Creates a Patrol-Member link.
     * @param Uid $uid
     * @param Patrol|IObjectPromise $patrol
     * @param Member|IObjectPromise $member
     * @param PatrolRole[] $roles
     */
    public function __construct(Uid $uid, $patrol, $member, $roles)
    {
        parent::__construct($uid);
        $this->setObject('patrol', $patrol, Patrol::class);
        $this->setObject('member', $member, Member::class);
        $this->setArray('roles', $roles, Arrays\PatrolRoleArray::class);
    }
}
