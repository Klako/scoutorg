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
 * @property-read Arrays\TroopMemberArray<string,TroopMember> $members
 * @property-read Arrays\PatrolArray<string,Patrol> $patrols
 */
class Troop extends OrgObject
{
    /**
     * Creates a new troop with the specified info.
     * @internal
     */
    public function __construct(
        Uid $uid,
        string $name,
        IObjectPromise $branch,
        IEdgeArrayPromise $members,
        IArrayPromise $patrols
    ) {
        parent::__construct($uid);
        $this->setProperty('name', $name);
        $this->setObject('branch', $branch);
        $this->setEdgeArray('members', $members);
        $this->setArray('patrols', $patrols);
    }
}
