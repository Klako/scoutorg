<?php

/**
 * Contains Scouterna\ScoutorgFactory class
 * @author Alexander Krantz
 */

namespace Scouterna\Scoutorg\Scoutnet;

use Scouterna\Scoutorg\Builder\Bases;
use Scouterna\Scoutorg\Builder\Bases\GroupMemberBase;
use Scouterna\Scoutorg\Model\Uid;
use Scouterna\Scoutorg\Builder\Link;

/**
 * Builds a scout group from scoutnet.
 */
class PartFactory
{
    /** @var ScoutnetController The source of data of which a scout group is built. */
    private $controller;
    private $source;

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
    public function __construct($controller, $source)
    {
        $this->controller = $controller;
        $this->source = $source;
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

        if ($scoutgroup == null) {
            return;
        }

        $this->scoutgroups->setBase($groupId, new Bases\ScoutGroupBase($scoutgroup->name));
    }

    public function buildMemberListData()
    {
        $groupId = $this->controller->getGroupId();

        if ($this->scoutgroups->hasLinks($groupId, 'members')) {
            return;
        }

        $this->scoutgroups->initLinks($groupId, 'members');

        $members = $this->controller->getMemberList();

        // Construct troops and patrols.
        foreach ($members as $member) {
            if (isset($member->unit)) {
                $troopId = intval($member->unit->rawValue);
                if (!$this->troops->hasBase($troopId)) {
                    $this->troops->setBase($troopId, new Bases\TroopBase($member->unit->value));
                    $this->scoutgroups->addLink($groupId, 'troops', new Link(new Uid($this->source, $troopId)));
                }

                if (isset($member->patrol)) {
                    $patrolId = intval($member->patrol->rawValue);
                    if (!$this->patrols->hasBase($patrolId)) {
                        $this->patrols->setBase($patrolId, new Bases\PatrolBase($member->patrol->value));
                        $this->troops->addLink($troopId, 'patrols', new Link(new Uid($this->source, $patrolId)));
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
            $this->groupMembers->setLink($groupMemberId, 'group', new Link(new Uid($this->source, $groupId)));
            $this->groupMembers->setLink($groupMemberId, 'member', new Link(new Uid($this->source, $memberId)));
            if (isset($member->getGroupRoles()[$groupId])) {
                foreach ($member->getGroupRoles()[$groupId] as $roleId => $roleName) {
                    if (!$this->groupRoles->hasBase($roleId)) {
                        $this->groupRoles->setBase($roleId, new Bases\GroupRoleBase($roleName));
                    }
                    $this->scoutgroups->addLink($groupId, 'grouproles', new Link(new Uid($this->source, $roleId)));
                    $this->groupMembers->addLink($groupMemberId, 'roles', new Link(new Uid($this->source, $roleId)));
                }
            }
            $this->scoutgroups->addLink($groupId, 'members', new Link(
                new Uid($this->source, $memberId),
                new Uid($this->source, $groupMemberId)
            ));
            $this->members->addLink($memberId, 'groups', new Link(
                new Uid($this->source, $groupId),
                new Uid($this->source, $groupMemberId)
            ));

            // Contacts.
            foreach ($member->getContacts() as $contactId => $contact) {
                $this->contacts->setBase($contactId, $contact);
                $this->members->addLink($memberId, 'contacts', new Link(new Uid($this->source, $contactId)));
            }

            // Troops and troop roles.
            foreach ($member->getTroops() as $troopId => $troopRoles) {
                $troopMemberId = "$troopId-$memberId";

                if ($this->troops->hasBase($troopId)) {
                    $this->troopMembers->setBase($troopMemberId, new Bases\TroopMemberBase());
                    $this->troopMembers->setLink($troopMemberId, 'troop', new Link(new Uid($this->source, $troopId)));
                    $this->troopMembers->setLink($troopMemberId, 'member', new Link(new Uid($this->source, $memberId)));
                    foreach ($troopRoles as $roleId => $roleName) {
                        if (!$this->troopRoles->hasBase($roleId)) {
                            $this->troopRoles->setBase($roleId, new Bases\TroopRoleBase($roleName));
                        }
                        $this->troopMembers->addLink($troopMemberId, 'roles', new Link(new Uid($this->source, $roleId)));
                        $this->scoutgroups->addLink($groupId, 'trooproles', new Link(new Uid($this->source, $roleId)));
                    }
                    $this->troops->addLink($troopId, 'members', new Link(
                        new Uid($this->source, $memberId),
                        new Uid($this->source, $troopMemberId)
                    ));
                    $this->members->addLink($memberId, 'troops', new Link(
                        new Uid($this->source, $troopId),
                        new Uid($this->source, $troopMemberId)
                    ));
                }
            }

            // Patrols and patrol roles.
            foreach ($member->getPatrols() as $patrolId => $patrolRoles) {
                $patrolMemberId = "$patrolId-$memberId";

                if ($this->patrols->hasBase($patrolId)) {
                    $this->patrols->addLink($patrolId, 'members', new Link(
                        new Uid($this->source, $memberId),
                        new Uid($this->source, $patrolMemberId)
                    ));
                    $this->patrolMembers->setBase($patrolMemberId, new bases\PatrolMemberBase());
                    $this->patrolMembers->setLink($patrolMemberId, 'patrol', new Link(new Uid($this->source, $patrolId)));
                    $this->patrolMembers->setLink($patrolMemberId, 'member', new Link(new Uid($this->source, $memberId)));
                    foreach ($patrolRoles as $roleId => $roleName) {
                        if (!$this->patrolRoles->hasBase($roleId)) {
                            $this->patrolRoles->setBase($roleId, new Bases\PatrolRoleBase($roleName));
                        }
                        $this->patrolMembers->addLink($patrolMemberId, 'roles', new Link(new Uid($this->source, $roleId)));
                        $this->scoutgroups->addLink($groupId, 'patrolroles', new Link(new Uid($this->source, $roleId)));
                    }
                    $this->members->addLink($memberId, 'patrols', new Link(
                        new Uid($this->source, $patrolId),
                        new Uid($this->source, $patrolMemberId)
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

        $this->scoutgroups->initLinks($groupId, 'customlists');

        $customlists = $this->controller->getCustomLists();

        foreach ($customlists as $customListId => $customList) {
            $this->customLists->setBase($customListId, new Bases\CustomListBase(
                $customList->title,
                $customList->description ?: ''
            ));
            $this->scoutgroups->addLink($groupId, 'customlists', new Link(new Uid($this->source, $customListId)));
            foreach ($customList->rules as $ruleId => $rule) {
                $ruleListId = "$customListId-$ruleId";

                $this->customLists->setBase($ruleListId, new bases\CustomListBase($rule->title, ''));
                $this->customLists->addLink($customListId, 'sublists', new Link(new Uid($this->source, $ruleListId)));
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
            $this->customLists->addLink($customListId, 'members', new Uid($this->source, $member->member_no->value));
        }
    }

    public function buildWaitingListData()
    {
        $groupId = $this->controller->getGroupId();

        if ($this->scoutgroups->hasLinks($groupId, 'waitinglist')) {
            return;
        }

        $this->scoutgroups->initLinks($groupId, 'waitinglist');

        $waitingMembers = $this->controller->getWaitingList();

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
                $this->members->addLink($memberId, 'contacts', new Link(new Uid($this->source, $contactId)));
            }
            $this->members->addLink($memberId, 'waitgroups', new Link(
                new Uid($this->source, $groupWaiterId),
                new Uid($this->source, $groupId)
            ));
            $this->scoutgroups->addLink($groupId, 'waitinglist', new Link(
                new Uid($this->source, $groupWaiterId),
                new Uid($this->source, $memberId)
            ));

            $this->groupWaiters->setBase($groupWaiterId, new Bases\GroupWaiterBase(
                $waitingMember->waiting_since->value
            ));
            $this->groupWaiters->setLink($groupWaiterId, 'group', new Link(new Uid($this->source, $groupId)));
            $this->groupWaiters->setLink($groupWaiterId, 'member', new Link(new Uid($this->source, $memberId)));
        }
    }
}
