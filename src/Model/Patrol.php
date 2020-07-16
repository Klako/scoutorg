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
     * @param string $source
     * @param int|string $id
     * @param string $name
     * @param Troop|IObjectPromise $troop
     * @param Arrays\PatrolMemberArray<Member> $members
     */
    public function __construct(string $source, $id,string $name, $troop, $members)
    {
        parent::__construct($source, $id);
        $this->setProperty('name', $name);
        $this->setObject('troop', $troop, Troop::class);
        $this->setArray('members', $members, Arrays\PatrolMemberArray::class);
    }
}
