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
     * @param IArrayPromise $members All members of the group.
     * @param IArrayPromise $troops
     * @param IArrayPromise $branches
     * @param IArrayPromise $groupRoles
     * @param IArrayPromise $troopRoles
     * @param IArrayPromise $patrolRoles
     * @param IArrayPromise $customLists
     * @param IArrayPromise $waitingList
     */
    public function __construct(
        Uid $uid,
        string $name,
        IEdgeArrayPromise $members,
        IArrayPromise $troops,
        IArrayPromise $branches,
        IArrayPromise $groupRoles,
        IArrayPromise $troopRoles,
        IArrayPromise $patrolRoles,
        IArrayPromise $customLists,
        IEdgeArrayPromise $waitingList
    ) {
        parent::__construct($uid);
        $this->setProperty('name', $name);
        $this->setEdgeArray('members', $members);
        $this->setArray('troops', $troops);
        $this->setArray('branches', $branches);
        $this->setArray('groupRoles', $groupRoles);
        $this->setArray('troopRoles', $troopRoles);
        $this->setArray('patrolRoles', $patrolRoles);
        $this->setArray('customLists', $customLists);
        $this->setEdgeArray('waitingList', $waitingList);
    }
}
