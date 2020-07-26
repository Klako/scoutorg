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
 * @property-read Arrays\PatrolRoleArray<string,PatrolRole> $roles
 */
class PatrolMember extends OrgObject
{
    /**
     * Creates a Patrol-Member link.
     */
    public function __construct(
        Uid $uid,
        IObjectPromise $patrol,
        IObjectPromise $member,
        IArrayPromise $roles
    ) {
        parent::__construct($uid);
        $this->setObject('patrol', $patrol);
        $this->setObject('member', $member);
        $this->setArray('roles', $roles);
    }
}
