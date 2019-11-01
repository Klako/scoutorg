<?php

/**
 * Contains ScoutorgFactory class
 * @author Alexander Krantz
 */

namespace Scoutorg\Scoutnet;

use Scoutorg\Builder\Configs;

/**
 * Builds a scout group from scoutnet.
 */
class ScoutorgFactory
{
    /** @var ScoutnetController[] The source of data of which a scout group is built. */
    private $controllers;

    private $scoutgroups = [];
    private $members = [];
    private $troops = [];
    private $patrols = [];
    private $roleGroups = [];
    private $customLists = [];
    private $waitingMembers = [];
    private $troopMembers = [];
    private $patrolMembers = [];
    private $contacts = [];

    /**
     * Creates a new scoutorg factory.
     * @param ScoutnetController[] $controllers
     */
    public function __construct(array $controllers)
    {
        foreach ($controllers as $controller) {
            $this->addController($controller);
        }
    }

    public function getControllers()
    {
        return $this->controllers;
    }

    public function addController(ScoutnetController $controller)
    {
        $this->controllers[$controller->getGroupId()] = $controller;
    }

    public function scoutGroupHandler($source, $id, $method)
    {
        if ($source !== 'scoutnet') {
            return false;
        }

        switch ($method) {
            case 'base':
                $this->buildScoutGroupData($id);
                break;
            case 'branches':
                return [];
            case 'members':
            case 'troops':
            case 'rolegroups':
                $this->buildMemberListData($id);
                break;
            case 'customlists':
                $this->buildCustomListData($id);
                break;
            case 'waitingmembers':
                $this->buildWaitingListData($id);
                break;
            default:
                return false;
        }

        return $this->scoutgroups[$id][$method];
    }

    public function memberHandler($source, $id, $method)
    {
        if ($source !== 'scoutnet') {
            return false;
        }

        if (!isset($this->members[$id])) {
            foreach ($this->controllers as $controller) {
                $this->buildMemberListData($controller->getGroupId());
                if (isset($this->members[$id])) {
                    break;
                }
            }
            if (!isset($this->members[$id])) {
                return false;
            }
        }


        switch ($method) {
            case 'base':
            case 'contacts':
            case 'troops':
            case 'patrols':
            case 'rolegroups':
                break;
            default:
                return false;
        }

        return $this->members[$id][$method];
    }

    public function troopHandler($source, $id, $method)
    {
        if ($source !== 'scoutnet') {
            return false;
        }

        if (!isset($this->troops[$id])) {
            foreach ($this->controllers as $controller) {
                $this->buildMemberListData($controller->getGroupId());
                if (isset($this->troops[$id])) {
                    break;
                }
            }
            if (!isset($this->troops[$id])) {
                return false;
            }
        }

        switch ($method) {
            case 'base':
            case 'patrols':
            case 'members':
                break;
            case 'branch':
                return null;
            default:
                return false;
        }

        return $this->troops[$id][$method];
    }

    public function troopMemberHandler($source, $id, $method)
    {
        if ($source !== 'scoutnet') {
            return false;
        }
        if (!isset($this->troopMembers[$id])) {
            foreach ($this->controllers as $controller) {
                $this->buildMemberListData($controller->getGroupId());
                if (isset($this->troopMembers[$id])) {
                    break;
                }
            }
            if (!isset($this->troopMembers[$id])) {
                return false;
            }
        }

        switch ($method) {
            case 'base':
            case 'troop':
            case 'member':
                break;
            default:
                return false;
        }

        return $this->troopMembers[$id][$method];
    }

    public function patrolHandler($source, $id, $method)
    {
        if ($source !== 'scoutnet') {
            return false;
        }

        if (!isset($this->patrols[$id])) {
            foreach ($this->controllers as $controller) {
                $this->buildMemberListData($controller->getGroupId());
                if (isset($this->patrols[$id])) {
                    break;
                }
            }
            if (!isset($this->patrols[$id])) {
                return false;
            }
        }

        switch ($method) {
            case 'base':
            case 'troop':
            case 'members':
                break;
            default:
                return false;
        }

        return $this->patrols[$id][$method];
    }

    public function patrolMemberHandler($source, $id, $method)
    {
        if ($source !== 'scoutnet') {
            return false;
        }

        if (!isset($this->patrolMembers[$id])) {
            foreach ($this->controllers as $controller) {
                $this->buildMemberListData($controller->getGroupId());
                if (isset($this->patrolMembers[$id])) {
                    break;
                }
            }
            if (!isset($this->patrolMembers[$id])) {
                return false;
            }
        }

        switch ($method) {
            case 'base':
            case 'patrol':
            case 'member':
                break;
            default:
                return false;
        }

        return $this->patrolMembers[$id][$method];
    }

    public function roleGroupHandler($source, $id, $method)
    {
        if ($source !== 'scoutnet') {
            return false;
        }

        if (!isset($this->roleGroups[$id])) {
            foreach ($this->controllers as $controller) {
                $this->buildMemberListData($controller->getGroupId());
                if (isset($this->roleGroups[$id])) {
                    break;
                }
            }
            if (!isset($this->roleGroups[$id])) {
                return false;
            }
        }

        switch ($method) {
            case 'base':
            case 'members':
                break;
            default:
                return false;
        }

        return $this->roleGroups[$id][$method];
    }

    public function contactHandler($source, $id, $method)
    {
        if ($source !== 'scoutnet') {
            return false;
        }

        if (!isset($this->contacts[$id])) {
            foreach ($this->controllers as $controller) {
                $this->buildMemberListData($controller->getGroupId());
                $this->buildWaitingListData($controller->getGroupId());
                if (isset($this->contacts[$id])) {
                    break;
                }
            }
            if (!isset($this->contacts[$id])) {
                return false;
            }
        }

        switch ($method) {
            case 'base':
                break;
            default:
                return false;
        }

        return $this->contacts[$id][$method];
    }

    public function customListHandler($source, $id, $method)
    {
        if ($source !== 'scoutnet') {
            return false;
        }
        if (!isset($this->customLists[$id])) {
            foreach ($this->controllers as $controller) {
                $this->buildCustomListData($controller->getGroupId());
                if (isset($this->customLists[$id])) {
                    break;
                }
            }
            if (!isset($this->customLists[$id])) {
                return false;
            }
        }

        switch ($method) {
            case 'base':
            case 'sublists':
                break;
            case 'members':
                $this->buildCustomListMemberData($id);
                break;
            default:
                return false;
        }

        return $this->customLists[$id][$method];
    }

    public function waitingmemberHandler($source, $id, $method)
    {
        if ($source !== 'scoutnet') {
            return false;
        }

        if (!isset($this->waitingMembers[$id])) {
            foreach ($this->controllers as $controller) {
                $this->buildWaitingListData($controller->getGroupId());
                if (isset($this->waitingMembers[$id])) {
                    break;
                }
            }
            if (!isset($this->waitingMembers[$id])) {
                return false;
            }
        }

        switch ($method) {
            case 'base':
            case 'contacts':
                break;
            default:
                return false;
        }

        return $this->waitingMembers[$id][$method];
    }

    /**
     * Creates a new scoutgroup from scoutnet.
     */
    private function buildScoutGroupData($groupId)
    {
        if (!isset($this->scoutgroups[$groupId])) {
            $this->scoutgroups[$groupId] = [];
        } elseif (isset($this->scoutgroups[$groupId]['base'])) {
            return;
        }
        $scoutgroup = $this->controllers[$groupId]->getGroupInfo();

        $this->scoutgroups[$groupId]['base'] = new Configs\ScoutGroupBase($scoutgroup->name);
    }

    private function buildMemberListData($groupId)
    {
        if (!isset($this->scoutgroups[$groupId])) {
            $this->scoutgroups[$groupId] = [];
        } elseif (isset($this->scoutgroups[$groupId]['members'])) {
            return;
        }

        $this->scoutgroups[$groupId]['members'] = [];
        $this->scoutgroups[$groupId]['troops'] = [];
        $this->scoutgroups[$groupId]['rolegroups'] = [];

        $members = $this->controllers[$groupId]->getMemberList();

        // Construct troops and patrols.
        foreach ($members as $member) {
            if (isset($member->unit)) {
                $troopId = intval($member->unit->rawValue);
                if (!isset($this->troops[$troopId])) {
                    $this->troops[$troopId] = [
                        'base' => new Configs\TroopBase($member->unit->value),
                        'members' => [],
                        'patrols' => [],
                    ];
                    $this->scoutgroups[$groupId]['troops'][] = new Configs\Uid('scoutnet', $troopId);
                }

                if (isset($member->patrol)) {
                    $patrolId = intval($member->patrol->rawValue);
                    if (!isset($this->patrols[$patrolId])) {
                        $this->patrols[$patrolId] = [
                            'base' => new Configs\PatrolBase($member->patrol->value),
                            'members' => [],
                        ];
                        $this->troops[$troopId]['patrols'][] = new Configs\Uid('scoutnet', $patrolId);
                    }
                }
            }
        }

        // Construct members and rolegroups.
        foreach ($members as $memberId => $member) {
            $this->members[$memberId] = [
                'base' => new Configs\MemberBase(
                    $member->getPersonInfo(),
                    $member->getContactInfo(),
                    $member->getHome(),
                    $member->confirmed_at->value
                ),
                'troops' => [],
                'patrols' => [],
                'rolegroups' => [],
                'contacts' => [],
            ];
            $this->scoutgroups[$groupId]['members'][] = new Configs\Uid('scoutnet', $memberId);

            foreach ($member->getContacts() as $contactId => $contact) {
                $this->contacts[$contactId] = [
                    'base' => $contact
                ];
                $this->members[$memberId]['contacts'][] = new Configs\Uid('scoutnet', $contactId);
            }

            foreach ($member->getTroops() as $troopId => $troop) {
                $troopMemberId = "$troopId-$memberId";

                if (isset($this->troops[$troopId])) {
                    $this->troops[$troopId]['members'][] = new Configs\LinkUid(
                        'scoutnet',
                        $troopMemberId,
                        new Configs\Uid('scoutnet', $memberId)
                    );
                    $this->troopMembers[$troopMemberId] = [
                        'base' => new Configs\TroopMemberBase($troop['role']),
                        'troop' => new Configs\Uid('scoutnet', $troopId),
                        'member' => new Configs\Uid('scoutnet', $memberId),
                    ];
                    $this->members[$memberId]['troops'][] = new Configs\LinkUid(
                        'scoutnet',
                        $troopMemberId,
                        new Configs\Uid('scoutnet', $troopId)
                    );
                }
            }

            foreach ($member->getPatrols() as $patrolId => $patrol) {
                $patrolMemberId = "$patrolId-$memberId";

                if (isset($this->patrols[$patrolId])) {
                    $this->patrols[$patrolId]['members'][] = new Configs\LinkUid(
                        'scoutnet',
                        $patrolMemberId,
                        new Configs\Uid('scoutnet', $memberId)
                    );
                    $this->patrolMembers[$patrolMemberId] = [
                        'base' => new Configs\PatrolMemberBase($patrol['role']),
                        'patrol' => new Configs\Uid('scoutnet', $patrolId),
                        'member' => new Configs\Uid('scoutnet', $memberId),
                    ];
                    $this->members[$memberId]['patrols'][] = new Configs\LinkUid(
                        'scoutnet',
                        $patrolMemberId,
                        new Configs\Uid('scoutnet', $patrolId)
                    );
                }
            }

            foreach ($member->getRoleGroups() as $roleGroupId => $roleGroup) {
                if (!isset($this->roleGroups[$roleGroupId])) {
                    $this->roleGroups[$roleGroupId] = [
                        'base' => new Configs\RoleGroupBase($roleGroup),
                        'members' => []
                    ];
                    $this->scoutgroups[$groupId]['rolegroups'][] = new Configs\Uid('scoutnet', $roleGroupId);
                }
                $this->roleGroups[$roleGroupId]['members'][] = new Configs\Uid('scoutnet', $memberId);
                $this->members[$memberId]['rolegroups'][] = new Configs\Uid('scoutnet', $roleGroupId);
            }
        }
    }

    private function buildCustomListData($groupId)
    {
        if (!isset($this->scoutgroups[$groupId])) {
            $this->scoutgroups[$groupId] = [];
        } elseif (isset($this->scoutgroups[$groupId]['customlists'])) {
            return;
        }

        $this->scoutgroups[$groupId]['customlists'] = [];

        $customlists = $this->controllers[$groupId]->getCustomLists();

        foreach ($customlists as $customListId => $customList) {
            $this->customLists[$customListId] = [
                'base' => new Configs\CustomListBase(
                    $customList->title,
                    $customList->description ? $customList->description : ''
                ),
                'members' => [],
                'sublists' => []
            ];
            $this->scoutgroups[$groupId]['customlists'][] = new Configs\Uid('scoutnet', $customListId);
            foreach ($customList->rules as $ruleId => $rule) {
                $ruleListId = "$customListId-$ruleId";
                $this->customLists[$ruleListId] = [
                    'base' => new Configs\CustomListBase($rule->title, ''),
                    'members' => null,
                    'sublists' => []
                ];
                $this->customLists[$customListId]['sublists'][] = new Configs\Uid('scoutnet', $ruleListId);
            }
        }
    }

    private function buildCustomListMemberData($customListId)
    {
        if (isset($this->customLists[$customListId]['members'])) {
            return;
        }

        $groupId = null;
        if (!isset($this->customLists[$customListId])) {
            foreach ($this->controllers as $controller) {
                $this->buildCustomListData($controller->getGroupId());
                if (isset($this->customLists[$customListId])) {
                    $groupId = $controller->getGroupId();
                    break;
                }
            }
            if (!isset($this->customLists[$customListId])) {
                return;
            }
        }

        $this->customLists[$customListId]['members'] = [];

        $parts = split('-', $customListId);
        if (count($parts) == 1) {
            $listId = $parts[0];
            $ruleId = CustomListRule::NO_RULE_ID;
        } else {
            $listId = $parts[0];
            $ruleId = $parts[1];
        }

        $members = $this->controllers[$groupId]->getCustomListMembers($listId, $ruleId);
        foreach ($members as $member) {
            $this->customLists[$customListId]['members'][] = new Configs\Uid(
                'scoutnet',
                intval($member->member_no->value)
            );
        }
    }

    private function buildWaitingListData($groupId)
    {
        if (isset($this->scoutgroups[$groupId]['waitingmembers'])) {
            return;
        }

        $this->scoutgroups[$groupId]['waitingmembers'] = [];

        $waitingMembers = $this->controllers[$groupId]->getWaitingList();

        foreach ($waitingMembers as $waitingMember) {
            $memberId = intval($waitingMember->member_no->value);
            $this->waitingMembers[$memberId] = [
                'base' => new Configs\WaitingMemberBase(
                    $waitingMember->getPersonInfo(),
                    $waitingMember->getContactInfo(),
                    $waitingMember->getHome(),
                    $waitingMember->waiting_since->value,
                    isset($waitingMember->note) ? $waitingMember->note->value : '',
                    isset($waitingMember->contact_leader_interest) ?
                        boolval($waitingMember->contact_leader_interest->value) : false
                ),
                'contacts' => []
            ];

            foreach ($waitingMember->getContacts() as $contactId => $contact) {
                $this->contacts[$contactId] = [
                    'base' => $contact
                ];
                $this->waitingMembers[$memberId]['contacts'][] = new Configs\Uid('scoutnet', $contactId);
            }
        }
    }
}
