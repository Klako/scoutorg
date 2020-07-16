<?php

/**
 * Contains TroopMember class.
 */

namespace Scouterna\Scoutorg\Model;

/**
 * A link between a Troop and a member,
 * containing information about the relationship.
 * @property-read Troop $troop
 * @property-read Member $member
 * @property-read Arrays\TroopRoleArray<mixed,TroopRole> $roles
 */
class TroopMember extends OrgObject
{
    /**
     * Creates a Troop-Member link.
     * @param Uid $uid
     * @param Troop|IObjectPromise $troop
     * @param Member|IObjectPromise $member
     * @param Arrays\TroopRoleArray|IArrayPromise $roles
     */
    public function __construct(Uid $uid, $troop, $member, $roles)
    {
        parent::__construct($uid);
        $this->setObject('troop', $troop, Troop::class);
        $this->setObject('member', $member, Member::class);
        $this->setArray('roles', $roles, Arrays\TroopRoleArray::class);
    }
}
