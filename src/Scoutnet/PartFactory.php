<?php

/**
 * Contains Scouterna\ScoutorgFactory class
 * @author Alexander Krantz
 */

namespace Scouterna\Scoutorg\Scoutnet;

use Scouterna\Scoutorg\Builder\Bases;
use Scouterna\Scoutorg\Builder\Bases\GroupMemberBase;
use Scouterna\Scoutorg\Builder\Uid;
use Scouterna\Scoutorg\Builder\EdgeUid;

/**
 * Builds a scout group from scoutnet.
 */
class PartFactory
{
    /** @var ScoutnetController The source of data of which a scout group is built. */
    private $controller;

    public $scoutgroups;
    public $troops;
    public $troopMembers;
    public $troopRoles;
    public $groupMembers;
    public $members;
    public $patrols;
    public $patrolMembers;
    public $patrolRoles;
    public $groupRoles;
    public $customLists;
    public $groupWaiters;
    public $contacts;

    /**
     * Creates a new Scouterna\Scoutorg factory.
     * @param ScoutnetController $controller
     * @param Table[] $tables
     */
    public function __construct($controller)
    {
        $this->controller = $controller;
        $this->scoutgroups = new Table;
        $this->troops = new Table;
        $this->troopMembers = new Table;
        $this->troopRoles = new Table;
        $this->groupMembers = new Table;
        $this->members = new Table;
        $this->patrols = new Table;
        $this->patrolMembers = new Table;
        $this->patrolRoles = new Table;
        $this->groupRoles = new Table;
        $this->customLists = new Table;
        $this->groupWaiters = new Table;
        $this->contacts = new Table;
    }

    /**
     * Creates a new scoutgroup from scoutnet.
     */
    public function buildScoutGroupData()
    {
        $groupId = $this->controller->getGroupId();

        if ($this->scoutgroups->hasBase($groupId)) {
            return;
        }

        $scoutgroup = $this->controller->getGroupInfo();

        $this->scoutgroups->setBase($groupId, new Bases\ScoutGroupBase($scoutgroup->name));
    }

    public function buildMemberListData()
    {
        $groupId = $this->controller->getGroupId();

        if ($this->scoutgroups->hasLinks($groupId, 'members')) {
            return;
        }

        $members = $this->controller->getMemberList();

        // Construct troops and patrols.
        foreach ($members as $member) {
            if (isset($member->unit)) {
                $troopId = intval($member->unit->rawValue);
                if (!$this->troops->hasBase($troopId)) {
                    $this->troops->setBase($troopId, new Bases\TroopBase($member->unit->value));
                    $this->scoutgroups->addLink($groupId, 'troops', new Uid('scoutnet', $troopId));
                }

                if (isset($member->patrol)) {
                    $patrolId = intval($member->patrol->rawValue);
                    if (!$this->patrols->hasBase($patrolId)) {
                        $this->patrols->setBase($patrolId, new Bases\PatrolBase($member->patrol->value));
                        $this->troops->addLink($troopId, 'patrols', new Uid('scoutnet', $patrolId));
                    }
                }
            }
        }

        // Construct members and grouproles.
        foreach ($members as $memberId => $member) {
            $this->members->setBase($memberId, new Bases\MemberBase(
                $member->getPersonInfo(),
                $member->getContactInfo(),
                $member->getHome(),
                $member->note->value ?? '',
                boolval($member->contact_leader_interest->value ?? false)
            ));

            // Group member and group roles.
            $groupMemberId = "$groupId-$memberId";
            $this->groupMembers->setBase($groupMemberId, new GroupMemberBase($member->confirmed_at->value));
            $this->groupMembers->setLink($groupMemberId, 'group', new Uid('scoutnet', $groupId));
            $this->groupMembers->setLink($groupMemberId, 'member', new Uid('scoutnet', $memberId));
            if (isset($member->getGroupRoles()[$groupId])) {
                foreach ($member->getGroupRoles()[$groupId] as $roleId => $roleName) {
                    if (!$this->groupRoles->hasBase($roleId)) {
                        $this->groupRoles->setBase($roleId, new Bases\GroupRoleBase($roleName));
                    }
                    $this->scoutgroups->addLink($groupId, 'grouproles', new Uid('scoutnet', $roleId));
                    $this->groupMembers->addLink($groupMemberId, 'roles', new Uid('scoutnet', $roleId));
                }
            }
            $this->scoutgroups->addLink($groupId, 'members', new EdgeUid(
                'scoutnet',
                $groupMemberId,
                new Uid('scoutnet', $memberId)
            ));
            $this->members->addLink($memberId, 'groups', new EdgeUid(
                'scoutnet',
                $groupMemberId,
                new Uid('scoutnet', $groupId)
            ));

            // Contacts.
            foreach ($member->getContacts() as $contactId => $contact) {
                $this->contacts->setBase($contactId, $contact);
                $this->members->addLink($memberId, 'contacts', new Uid('scoutnet', $contactId));
            }

            // Troops and troop roles.
            foreach ($member->getTroops() as $troopId => $troopRoles) {
                $troopMemberId = "$troopId-$memberId";

                if ($this->troops->hasBase($troopId)) {
                    $this->troopMembers->setBase($troopMemberId, new Bases\TroopMemberBase());
                    $this->troopMembers->setLink($troopMemberId, 'troop', new Uid('scoutnet', $troopId));
                    $this->troopMembers->setLink($troopMemberId, 'member', new Uid('scoutnet', $memberId));
                    foreach ($troopRoles as $roleId => $roleName) {
                        if (!$this->troopRoles->hasBase($roleId)) {
                            $this->troopRoles->setBase($roleId, new Bases\TroopRoleBase($roleName));
                        }
                        $this->troopMembers->addLink($troopMemberId, 'roles', new Uid('scoutnet', $roleId));
                        $this->scoutgroups->addLink($groupId, 'trooproles', new Uid('scoutnet', $roleId));
                    }
                    $this->troops->addLink($troopId, 'members', new EdgeUid(
                        'scoutnet',
                        $troopMemberId,
                        new Uid('scoutnet', $memberId)
                    ));
                    $this->members->addLink($memberId, 'troops', new EdgeUid(
                        'scoutnet',
                        $troopMemberId,
                        new Uid('scoutnet', $troopId)
                    ));
                }
            }

            // Patrols and patrol roles.
            foreach ($member->getPatrols() as $patrolId => $patrolRoles) {
                $patrolMemberId = "$patrolId-$memberId";

                if ($this->patrols->hasBase($patrolId)) {
                    $this->patrols->addLink($patrolId, 'members', new EdgeUid(
                        'scoutnet',
                        $patrolMemberId,
                        new Uid('scoutnet', $memberId)
                    ));
                    $this->patrolMembers->setBase($patrolMemberId, new bases\PatrolMemberBase());
                    $this->patrolMembers->setLink($patrolMemberId, 'patrol', new Uid('scoutnet', $patrolId));
                    $this->patrolMembers->setLink($patrolMemberId, 'member', new Uid('scoutnet', $memberId));
                    foreach ($patrolRoles as $roleId => $roleName) {
                        if (!$this->patrolRoles->hasBase($roleId)) {
                            $this->patrolRoles->setBase($roleId, new Bases\PatrolRoleBase($roleName));
                        }
                        $this->patrolMembers->addLink($patrolMemberId, 'roles', new Uid('scoutnet', $roleId));
                        $this->scoutgroups->addLink($groupId, 'patrolroles', new Uid('scoutnet', $roleId));
                    }
                    $this->members->addLink($memberId, 'patrols', new EdgeUid(
                        'scoutnet',
                        $patrolMemberId,
                        new Uid('scoutnet', $patrolId)
                    ));
                }
            }
        }
    }

    public function buildCustomListData()
    {
        $groupId = $this->controller->getGroupId();

        if ($this->scoutgroups->hasLinks($groupId, 'customlists')) {
            return;
        }

        $customlists = $this->controller->getCustomLists();

        foreach ($customlists as $customListId => $customList) {
            $this->customLists->setBase($customListId, new Bases\CustomListBase(
                $customList->title,
                $customList->description ?: ''
            ));
            $this->scoutgroups->addLink($groupId, 'customlists', new Uid('scoutnet', $customListId));
            foreach ($customList->rules as $ruleId => $rule) {
                $ruleListId = "$customListId-$ruleId";

                $this->customLists->setBase($ruleListId, new bases\CustomListBase($rule->title, ''));
                $this->customLists->addLink($customListId, 'sublists', new Uid('scoutnet', $ruleListId));
            }
        }
    }

    public function buildCustomListMemberData($customListId)
    {
        if ($this->customLists->hasLinks($customListId, 'members')) {
            return;
        }

        $this->customLists->initLinks($customListId, 'members');

        $groupId = $this->controller->getGroupId();
        if (!$this->customLists->hasBase($customListId)) {
            $this->buildCustomListData($groupId);
        }

        $parts = \explode('-', $customListId);
        if (count($parts) == 1) {
            $listId = $parts[0];
            $ruleId = CustomListRule::NO_RULE_ID;
        } else {
            $listId = $parts[0];
            $ruleId = $parts[1];
        }

        $members = $this->controller[$groupId]->getCustomListMembers($listId, $ruleId);
        foreach ($members as $member) {
            $this->customLists->addLink($customListId, 'members', new Uid('scoutnet', $member->member_no->value));
        }
    }

    public function buildWaitingListData()
    {
        $groupId = $this->controller->getGroupId();

        if ($this->scoutgroups->hasLinks($groupId, 'waitingmembers')) {
            return;
        }

        $waitingMembers = $this->controller->getWaitingList();
        $this->scoutgroups->initLinks($groupId, 'waitinglist');

        foreach ($waitingMembers as $waitingMember) {
            $memberId = intval($waitingMember->member_no->value);
            $groupWaiterId = "$groupId-$memberId";

            $this->members->setBase($memberId, new Bases\MemberBase(
                $waitingMember->getPersonInfo(),
                $waitingMember->getContactInfo(),
                $waitingMember->getHome(),
                $waitingMember->note->value ?? '',
                $waitingMember->contact_leader_interest->value ?? false
            ));
            $this->members->initLinks($memberId, 'contacts');
            foreach ($waitingMember->getContacts() as $contactId => $contact) {
                $this->contacts->setBase($contactId, $contact);
                $this->members->addLink($memberId, 'contacts', new Uid('scoutnet', $contactId));
            }
            $this->members->addLink($memberId, 'waitgroups', new EdgeUid(
                'scoutnet',
                $groupId,
                new Uid('scoutnet', $groupWaiterId)
            ));
            $this->scoutgroups->addLink($groupId, 'waitinglist', new EdgeUid(
                'scoutnet',
                $memberId,
                new Uid('scoutnet', $groupWaiterId)
            ));

            $this->groupWaiters->setBase($groupWaiterId, new Bases\GroupWaiterBase(
                $waitingMember->waiting_since->value
            ));
            $this->groupWaiters->setLink($groupWaiterId, 'group', new Uid('scoutnet', $groupId));
            $this->groupWaiters->setLink($groupWaiterId, 'member', new Uid('scoutnet', $memberId));
        }
    }
}
