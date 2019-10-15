<?php

/**
 * Contains TroopMember class.
 */

namespace Scoutorg\Lib;

/**
 * A link between a Troop and a member,
 * containing information about the relationship.
 * @property-read Member $member
 * @property-read string $role
 */
class TroopMember extends OrgObject
{
    /**
     * Creates a Troop-Member link.
     * @param IObjectMutator $mutator
     * @param int|IPropertyProvider $id
     * @param Member|IPropertyProvider $member
     * @param string|IPropertyProvider $role
     */
    public function __construct(IObjectMutator $mutator, $id, $member, $role)
    {
        parent::__construct($mutator, $id);
        $this->setProperty('member', [Member::class], $member);
        $this->setProperty('role', ['string'], $role);
    }
}
