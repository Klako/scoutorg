<?php

/**
 * Contains Patrol class
 * @author Alexander Krantz
 */

namespace Scoutorg\Lib;

/**
 * A scout patrol that is in a troop.
 * @property-read string $name
 * @property-read Troop $troop
 * @property-read Arrays\PatrolMemberArray<PatrolMember> $members
 */
class Patrol extends OrgObject
{
    /**
     * Creates a new patrol.
     * @internal
     * @param string $source
     * @param int|string $id
     * @param string $name
     * @param Troop $troop
     * @param OrgArray<int,Member> $members
     */
    public function __construct(string $source, $id,string $name, $troop, $members)
    {
        parent::__construct($source, $id);
        $this->setProperty('name', $name);
        $this->setObject('troop', $troop, Troop::class);
        $this->setArray('members', $members, Arrays\PatrolMemberArray::class);
    }
}
