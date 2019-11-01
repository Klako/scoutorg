<?php

/**
 * Contains Troop class
 * @author Alexander Krantz
 */

namespace Scoutorg\Lib;

/**
 * A troop that is in the scout group.
 * @property-read string $name
 * @property-read Branch|null $branch
 * @property-read Dummys\TroopMemberArray<int,TroopMember> $members
 * @property-read Dummys\PatrolArray<int,Patrol> $patrols
 */
class Troop extends OrgObject
{
    /**
     * Creates a new troop with the specified info.
     * @internal
     * @param string $source
     * @param int|string $id
     * @param string $name The troop name.
     * @param Branch|null $branch
     * @param OrgArray<int,Member> $members
     * @param OrgArray<int,Patrol> $patrols
     */
    public function __construct($source, $id, $name, $branch, $members, $patrols)
    {
        parent::__construct($source, $id);
        $this->setProperty('name', ['string'], $name);
        $this->setProperty('branch', [Branch::class, 'NULL'], $branch);
        $this->setProperty('members', [OrgArray::class], $members);
        $this->setProperty('patrols', [OrgArray::class], $patrols);
    }
}
