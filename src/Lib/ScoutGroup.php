<?php

/**
 * Contains ScoutGroup class
 * @author Alexander Krantz
 */

namespace Scoutorg\Lib;

/**
 * The whole scout group that is part of the scout organisation.
 * @property-read string $name
 * @property-read Arrays\GroupMemberArray<mixed,Member> $members
 * @property-read Arrays\TroopArray<mixed,Troop> $troops
 * @property-read Arrays\BranchArray<mixed,Branch> $branches
 * @property-read Arrays\GroupRoleArray<mixed,GroupRole> $groupRoles
 * @property-read Arrays\CustomListArray<mixed,CustomList> $customLists
 * @property-read Arrays\WaitingMemberArray<mixed,WaitingList> $waitingList
 */
class ScoutGroup extends OrgObject
{
    /**
     * Creates a new ScoutGroup with the specified id.
     * @internal
     * @param string $source
     * @param int|string $id
     * @param string $name
     * @param GroupMemberArray<Member> $members All members of the group.
     * @param TroopArray<Troop> $troops
     * @param BranchArray<Branch> $branches
     * @param GroupRoleArray<GroupRole> $groupRoles
     * @param CustomListArray<CustomList> $customLists
     * @param WaitingMemberArray<WaitingList> $waitingList
     */
    public function __construct(
        string $source,
        $id,
        string $name,
        $members,
        $troops,
        $branches,
        $groupRoles,
        $customLists,
        $waitingList
    ) {
        parent::__construct($source, $id);
        $this->setProperty('name', $name);
        $this->setArray('members', $members, Arrays\GroupMemberArray::class);
        $this->setArray('troops', $troops, Arrays\TroopArray::class);
        $this->setArray('branches', $branches, Arrays\BranchArray::class);
        $this->setArray('groupRoles', $groupRoles, Arrays\GroupRoleArray::class);
        $this->setArray('customLists', $customLists, Arrays\CustomListArray::class);
        $this->setArray('waitingList', $waitingList, Arrays\GroupWaiterArray::class);
    }
}
