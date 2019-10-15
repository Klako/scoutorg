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
 * @property-read OrgArray<int,Member> $members
 * @property-read OrgArray<int,Patrol> $patrols
 */
class Troop extends OrgObject
{
    /**
     * Creates a new troop with the specified info.
     * @internal
     * @param IObjectMutator $mutator
     * @param int|IPropertyProvider $id The troop scoutnet id.
     * @param string|IPropertyProvider $name The troop name.
     * @param Branch|null|IPropertyProvider $branch
     * @param OrgArray<int,Member>|IPropertyProvider $members
     * @param OrgArray<int,Patrol>|IPropertyProvider $patrols
     */
    public function __construct(IObjectMutator $mutator, $id, $name, $branch, $members, $patrols)
    {
        parent::__construct($mutator, $id);
        $this->setProperty('name', ['string'], $name);
        $this->setProperty('branch', [Branch::class, 'null'], $branch);
        $this->setProperty('members', [OrgArray::class], $members);
        $this->setProperty('patrols', [OrgArray::class], $patrols);
    }
}
