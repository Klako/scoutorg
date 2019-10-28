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
 * @property-read PatrolMemberArray<int,PatrolMember> $members
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
    public function __construct($source, $id, $name, $troop, $members)
    {
        parent::__construct($source, $id);
        $this->setProperty('name', ['string'], $name);
        $this->setProperty('troop', [Troop::class], $troop);
        $this->setProperty('members', [OrgArray::class], $members);
    }
}
