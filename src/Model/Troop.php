<?php

/**
 * Contains Troop class
 * @author Alexander Krantz
 */

namespace Scouterna\Scoutorg\Model;

/**
 * A troop that is in the scout group.
 * @property-read string $name
 * @property-read Branch|null $branch
 * @property-read Arrays\TroopMemberArray<mixed,TroopMember> $members
 * @property-read Arrays\PatrolArray<mixed,Patrol> $patrols
 */
class Troop extends OrgObject
{
    /**
     * Creates a new troop with the specified info.
     * @internal
     * @param Uid $uid
     * @param string $name The troop name.
     * @param IObjectPromise $branch
     * @param IArrayPromise $members
     * @param IArrayPromise $patrols
     */
    public function __construct(Uid $uid, string $name, IObjectPromise $branch, IArrayPromise $members, IArrayPromise $patrols)
    {
        parent::__construct($uid);
        $this->setProperty('name', $name);
        $this->setObject('branch', $branch, Branch::class);
        $this->setArray('members', $members, Arrays\TroopMemberArray::class);
        $this->setArray('patrols', $patrols, Arrays\PatrolArray::class);
    }
}
