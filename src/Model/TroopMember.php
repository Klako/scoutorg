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
     * @param IObjectPromise $troop
     * @param IObjectPromise $member
     * @param IArrayPromise $roles
     */
    public function __construct(
        Uid $uid,
        IObjectPromise $troop,
        IArrayPromise $member,
        IArrayPromise $roles
    ) {
        parent::__construct($uid);
        $this->setObject('troop', $troop);
        $this->setObject('member', $member);
        $this->setArray('roles', $roles);
    }
}
