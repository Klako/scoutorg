<?php

/**
 * Contains ScoutGroup class
 * @author Alexander Krantz
 */

namespace Scoutorg\Lib;

/**
 * The whole scout group that is part of the scout organisation.
 * @property-read OrgArray<int,Member> $members
 * @property-read OrgArray<int,Troop> $troops
 * @property-read OrgArray<int,Branch> $branches
 * @property-read OrgArray<int,RoleGroup> $roleGroups
 * @property-read OrgArray<int,CustomList> $customLists
 * @property-read OrgArray<int,WaitingList> $waitingList
 */
class ScoutGroup extends OrgObject
{
    /**
     * Creates a new ScoutGroup with the specified id.
     * @internal
     * @param int $id The scout group id.
     * @param string $name
     * @param OrgArray<int,Member>|IPropertyProvider $members All members of the group.
     * @param OrgArray<int,Troop>|IPropertyProvider $troops
     * @param OrgArray<int,Branch>|IPropertyProvider $branches
     * @param OrgArray<int,RoleGroup>|IPropertyProvider $roleGroups
     * @param OrgArray<int,CustomList>|IPropertyProvider $customLists
     * @param OrgArray<int,WaitingList>|IPropertyProvider $waitingList
     */
    public function __construct(
        IObjectMutator $mutator,
        $id,
        $name,
        $members,
        $troops,
        $branches,
        $roleGroups,
        $customLists,
        $waitingList
    ) {
        parent::__construct($mutator, $id);
        $this->setProperty('name', ['string'], $name, false);
        $this->setProperty('members', [OrgArray::class], $members);
        $this->setProperty('troops', [OrgArray::class], $troops);
        $this->setProperty('branches', [OrgArray::class], $branches);
        $this->setProperty('roleGroups', [OrgArray::class], $roleGroups);
        $this->setProperty('customLists', [OrgArray::class], $customLists);
        $this->setProperty('waitingList', [OrgArray::class], $waitingList);
    }
}
