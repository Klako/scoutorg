<?php

/**
 * Contains ScoutGroup class
 * @author Alexander Krantz
 */

namespace Scouterna\Scoutorg\Model;

/**
 * The whole scout group that is part of the scout organisation.
 * @property-read string $name
 * @property-read Arrays\GroupMemberArray<mixed,GroupMember> $members
 * @property-read Arrays\TroopArray<mixed,Troop> $troops
 * @property-read Arrays\BranchArray<mixed,Branch> $branches
 * @property-read Arrays\GroupRoleArray<mixed,GroupRole> $groupRoles
 * @property-read Arrays\TroopRoleArray<mixed,TroopRole> $troopRoles
 * @property-read Arrays\PatrolRoleArray<mixed,PatrolRole> $patrolRoles
 * @property-read Arrays\CustomListArray<mixed,CustomList> $customLists
 * @property-read Arrays\GroupWaiterArray<mixed,GroupWaiter> $waitingList
 */
class ScoutGroup extends OrgObject
{
    /**
     * Creates a new ScoutGroup with the specified id.
     * @internal
     * @param Uid $uid
     * @param string $name
     * @param Arrays\GroupMemberArray|IArrayPromise $members All members of the group.
     * @param Arrays\TroopArray|IArrayPromise $troops
     * @param Arrays\BranchArray|IArrayPromise $branches
     * @param Arrays\GroupRoleArray|IArrayPromise $groupRoles
     * @param Arrays\TroopRoleArray|IArrayPromise $troopRoles
     * @param Arrays\PatrolRoleArray|IArrayPromise $patrolRoles
     * @param Arrays\CustomListArray|IArrayPromise $customLists
     * @param Arrays\GroupWaiterArray|IArrayPromise $waitingList
     */
    public function __construct(
        Uid $uid,
        string $name,
        $members,
        $troops,
        $branches,
        $groupRoles,
        $troopRoles,
        $patrolRoles,
        $customLists,
        $waitingList
    ) {
        parent::__construct($uid);
        $this->setProperty('name', $name);
        $this->setArray('members', $members, Arrays\GroupMemberArray::class);
        $this->setArray('troops', $troops, Arrays\TroopArray::class);
        $this->setArray('branches', $branches, Arrays\BranchArray::class);
        $this->setArray('groupRoles', $groupRoles, Arrays\GroupRoleArray::class);
        $this->setArray('troopRoles', $troopRoles, Arrays\TroopRoleArray::class);
        $this->setArray('patrolRoles', $patrolRoles, Arrays\PatrolRoleArray::class);
        $this->setArray('customLists', $customLists, Arrays\CustomListArray::class);
        $this->setArray('waitingList', $waitingList, Arrays\GroupWaiterArray::class);
    }
}
