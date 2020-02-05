<?php

/**
 * Contains PatrolMember class.
 */

namespace Scoutorg\Lib;

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
     * @param string $source
     * @param int|string $id
     * @param Patrol $patrol
     * @param Member $member
     * @param PatrolRole[] $roles
     */
    public function __construct(string $source, $id, $patrol, $member, $roles)
    {
        parent::__construct($source, $id);
        $this->setObject('patrol', $patrol, Patrol::class);
        $this->setObject('member', $member, Member::class);
        $this->setArray('roles', $roles, Arrays\PatrolRoleArray::class);
    }
}
