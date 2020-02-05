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
 * @property-read Arrays\TroopMemberArray<mixed,TroopMember> $members
 * @property-read Arrays\PatrolArray<mixed,Patrol> $patrols
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
     * @param OrgArray<TroopMember> $members
     * @param OrgArray<Patrol> $patrols
     */
    public function __construct(string $source, $id, string $name, $branch, $members, $patrols)
    {
        parent::__construct($source, $id);
        $this->setProperty('name', $name);
        $this->setObject('branch', $branch, Branch::class);
        $this->setArray('members', $members, Arrays\TroopMemberArray::class);
        $this->setArray('patrols', $patrols, Arrays\PatrolArray::class);
    }
}
