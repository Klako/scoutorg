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
 * @property-read Arrays\TroopRoleArray<string,TroopRole> $roles
 */
class TroopMember extends OrgObject
{
    /**
     * Creates a Troop-Member link.
     * @internal
     */
    public function __construct(
        Uid $uid,
        IObjectPromise $troop,
        IObjectPromise $member,
        IArrayPromise $roles
    ) {
        parent::__construct($uid);
        $this->setObject('troop', $troop);
        $this->setObject('member', $member);
        $this->setArray('roles', $roles);
    }
}
