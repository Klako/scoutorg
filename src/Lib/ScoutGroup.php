<?php

/**
 * Contains ScoutGroup class
 * @author Alexander Krantz
 */

namespace Scoutorg\Lib;

/**
 * The whole scout group that is part of the scout organisation.
 * @property-read string $name
 * @property-read Dummys\MemberArray<int,Member> $members
 * @property-read Dummys\TroopArray<int,Troop> $troops
 * @property-read Dummys\BranchArray<int,Branch> $branches
 * @property-read Dummys\RoleGroupArray<int,RoleGroup> $roleGroups
 * @property-read Dummys\CustomListArray<int,CustomList> $customLists
 * @property-read Dummys\WaitingMemberArray<int,WaitingList> $waitingList
 */
class ScoutGroup extends OrgObject
{
    /**
     * Creates a new ScoutGroup with the specified id.
     * @internal
     * @param string $source
     * @param int|string $id
     * @param string $name
     * @param MemberArray<int,Member> $members All members of the group.
     * @param TroopArray<int,Troop> $troops
     * @param BranchArray<int,Branch> $branches
     * @param RoleGroupArray<int,RoleGroup> $roleGroups
     * @param CustomListArray<int,CustomList> $customLists
     * @param WaitingMemberArray<int,WaitingList> $waitingList
     */
    public function __construct(
        $source,
        $id,
        $name,
        $members,
        $troops,
        $branches,
        $roleGroups,
        $customLists,
        $waitingList
    ) {
        parent::__construct($source, $id);
        $this->setProperty('name', ['string'], $name);
        $this->setProperty('members', [OrgArray::class], $members);
        $this->setProperty('troops', [OrgArray::class], $troops);
        $this->setProperty('branches', [OrgArray::class], $branches);
        $this->setProperty('roleGroups', [OrgArray::class], $roleGroups);
        $this->setProperty('customLists', [OrgArray::class], $customLists);
        $this->setProperty('waitingList', [OrgArray::class], $waitingList);
    }
}
