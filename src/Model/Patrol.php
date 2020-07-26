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
 * @property-read Arrays\PatrolMemberArray<string,PatrolMember> $members
 */
class Patrol extends OrgObject
{
    /**
     * Creates a new patrol.
     * @internal
     */
    public function __construct(
        Uid $uid,
        string $name,
        IObjectPromise $troop,
        IEdgeArrayPromise $members
    ) {
        parent::__construct($uid);
        $this->setProperty('name', $name);
        $this->setObject('troop', $troop);
        $this->setEdgeArray('members', $members);
    }
}
