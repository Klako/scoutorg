<?php

/**
 * Contains TroopMember class.
 */

namespace Scoutorg\Lib;

/**
 * A link between a Troop and a member,
 * containing information about the relationship.
 * @property-read Troop $troop
 * @property-read Member $member
 * @property-read string $role
 */
class TroopMember extends OrgObject
{
    /**
     * Creates a Troop-Member link.
     * @param string $source
     * @param int|string $id
     * @param Troop $troop
     * @param Member $member
     * @param string $role
     */
    public function __construct($source, $id, $troop, $member, $role)
    {
        parent::__construct($source, $id);
        $this->setProperty('troop', [Troop::class], $troop);
        $this->setProperty('member', [Member::class], $member);
        $this->setProperty('role', ['string'], $role);
    }
}