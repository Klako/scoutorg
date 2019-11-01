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
 * @property-read string[] $roles
 */
class PatrolMember extends OrgObject
{
    /**
     * Creates a Patrol-Member link.
     * @param string $source
     * @param int|string $id
     * @param Patrol $patrol
     * @param Member $member
     * @param string[] $roles
     */
    public function __construct($source, $id, $patrol, $member, $roles)
    {
        parent::__construct($source, $id);
        $this->setProperty('patrol', [Patrol::class], $patrol);
        $this->setProperty('member', [Member::class], $member);
        $this->setProperty('role', ['array'], $roles);
    }
}
