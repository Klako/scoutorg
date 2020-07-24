<?php

/**
 * Contains Patrol class
 * @author Alexander Krantz
 */

namespace Scouterna\Scoutorg\Model;

/**
 * A scout patrol that is in a troop.
 * @property-read string $name
 * @property-read Troop $troop
 * @property-read Arrays\PatrolMemberArray<mixed,PatrolMember> $members
 */
class Patrol extends OrgObject
{
    /**
     * Creates a new patrol.
     * @internal
     * @param Uid $uid
     * @param string $name
     * @param IObjectPromise $troop
     * @param IArrayPromise $members
     */
    public function __construct(Uid $uid, string $name, IObjectPromise $troop, IArrayPromise $members)
    {
        parent::__construct($uid);
        $this->setProperty('name', $name);
        $this->setObject('troop', $troop);
        $this->setArray('members', $members);
    }
}
