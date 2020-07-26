<?php

/**
 * Contains ScoutGroup class
 * @author Alexander Krantz
 */

namespace Scouterna\Scoutorg\Model;

/**
 * The whole scout group that is part of the scout organisation.
 * @property-read string $name
 * @property-read Arrays\GroupMemberArray<string,GroupMember> $members
 * @property-read Arrays\TroopArray<string,Troop> $troops
 * @property-read Arrays\BranchArray<string,Branch> $branches
 * @property-read Arrays\GroupRoleArray<string,GroupRole> $groupRoles
 * @property-read Arrays\TroopRoleArray<string,TroopRole> $troopRoles
 * @property-read Arrays\PatrolRoleArray<string,PatrolRole> $patrolRoles
 * @property-read Arrays\CustomListArray<string,CustomList> $customLists
 * @property-read Arrays\GroupWaiterArray<string,GroupWaiter> $waitingList
 */
class ScoutGroup extends OrgObject
{
    /**
     * Creates a new ScoutGroup with the specified id.
     * @internal
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
