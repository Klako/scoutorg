<?php

/**
 * Contains ScoutGroup class
 * @author Alexander Krantz
 */

namespace Scoutorg\Lib;

use Scoutorg\Lib\Dummies\GroupRoleArray;

/**
 * The whole scout group that is part of the scout organisation.
 * @property-read string $name
 * @property-read Dummies\MemberArray<int,Member> $members
 * @property-read Dummies\TroopArray<int,Troop> $troops
 * @property-read Dummies\BranchArray<int,Branch> $branches
 * @property-read Dummies\GroupRoleArray<int,GroupRole> $groupRoles
 * @property-read Dummies\CustomListArray<int,CustomList> $customLists
 * @property-read Dummies\WaitingMemberArray<int,WaitingList> $waitingList
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
     * @param GroupRoleArray<int,GroupRole> $groupRoles
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
        $groupRoles,
        $customLists,
        $waitingList
    ) {
        parent::__construct($source, $id);
        $this->setProperty('name', ['string'], $name);
        $this->setProperty('members', [OrgArray::class], $members);
        $this->setProperty('troops', [OrgArray::class], $troops);
        $this->setProperty('branches', [OrgArray::class], $branches);
        $this->setProperty('groupRoles', [OrgArray::class], $groupRoles);
        $this->setProperty('customLists', [OrgArray::class], $customLists);
        $this->setProperty('waitingList', [OrgArray::class], $waitingList);
    }
}
