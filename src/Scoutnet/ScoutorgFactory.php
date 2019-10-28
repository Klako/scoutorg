<?php

/**
 * Contains ScoutorgFactory class
 * @author Alexander Krantz
 */

namespace Scoutorg\Scoutnet;

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
                $t = \microtime(true);
                $this->buildMemberListData($id);
                echo "built member list data in " . (\microtime(true) - $t) . " seconds\n";
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

        foreach ($this->controllers as $controller) {
            $this->buildMemberListData($controller->getGroupId());
            if (isset($this->members[$id])) {
                break;
            }
        }
        if (!isset($this->members[$id])) {
            return false;
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

        foreach ($this->controllers as $controller) {
            $this->buildMemberListData($controller->getGroupId());
            if (isset($this->troops[$id])) {
                break;
            }
        }
        if (!isset($this->troops[$id])) {
            return false;
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

        foreach ($this->controllers as $controller) {
            $this->buildMemberListData($controller->getGroupId());
            if (isset($this->troopMembers[$id])) {
                break;
            }
        }
        if (!isset($this->troopMembers[$id])) {
            return false;
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

        foreach ($this->controllers as $controller) {
            $this->buildMemberListData($controller->getGroupId());
            if (isset($this->patrols[$id])) {
                break;
            }
        }
        if (!isset($this->patrols[$id])) {
            return false;
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

        foreach ($this->controllers as $controller) {
            $this->buildMemberListData($controller->getGroupId());
            if (isset($this->patrolMembers[$id])) {
                break;
            }
        }
        if (!isset($this->patrolMembers[$id])) {
            return false;
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

        foreach ($this->controllers as $controller) {
            $this->buildMemberListData($controller->getGroupId());
            if (isset($this->roleGroups[$id])) {
                break;
            }
        }
        if (!isset($this->roleGroups[$id])) {
            return false;
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
        }
        if (!isset($this->customLists[$id])) {
            return false;
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

        foreach ($this->controllers as $controller) {
            $this->buildWaitingListData($controller->getGroupId());
            if (isset($this->members[$id])) {
                break;
            }
        }
        if (!isset($this->members[$id])) {
            return false;
        }

        switch ($method) {
            case 'base':
            case 'contacts':
                break;
            default:
                return false;
        }

        return $this->members[$id][$method];
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

        $this->scoutgroups[$groupId]['base'] = [
            'name' => $scoutgroup->name
        ];
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

        $t = \microtime(true);
        $members = $this->controllers[$groupId]->getMemberList();
        echo 'Got member list in ' . (\microtime(true) - $t) . " seconds\n";
        $troops = [];
        $patrols = [];
        $troopmembers = [];
        $patrolmembers = [];

        $t = \microtime(true);
        foreach ($members as $memberId => $member) {
            $this->members[$memberId] = [
                'base' => [
                    'personinfo' => $member->getPersonInfo(),
                    'contactinfo' => $member->getContactInfo(),
                    'home' => $member->getHome(),
                    'startdate' => $member->confirmed_at->value,
                ],
                'troops' => [],
                'patrols' => [],
                'rolegroups' => [],
                'contacts' => [],
            ];
            $this->scoutgroups[$groupId]['members'][] = [
                'source' => 'scoutnet',
                'id' => $memberId
            ];

            foreach ($member->getContacts() as $contactId => $contact) {
                $this->contacts[$contactId] = [
                    'base' => $contact
                ];
                $this->members[$memberId]['contacts'][] = [
                    'source' => 'scoutnet',
                    'id' => $contactId
                ];
            }

            foreach ($member->getTroops() as $troopId => $troop) {
                $troopMemberId = "$troopId-{$memberId}";

                if (isset($troops[$troopId])) {
                    if (!isset($troops[$troopId]['base']['name']) && isset($troop['name'])) {
                        $troops[$troopId]['base']['name'] = $troop['name'];
                    }
                } else {
                    $troops[$troopId] = [
                        'base' => [
                            'name' => isset($troop['name']) ? $troop['name'] : null,
                        ],
                        'members' => [],
                        'patrols' => [],
                    ];
                }

                $troops[$troopId]['members'][] = [
                    'source' => 'scoutnet',
                    'id' => $troopMemberId,
                    'target' => [
                        'source' => 'scoutnet',
                        'id' => $memberId,
                    ]
                ];

                $troopmembers[$troopMemberId] = [
                    'base' => [
                        'role' => isset($troop['role']) ? $troop['role'] : '',
                    ],
                    'troop' => [
                        'source' => 'scoutnet',
                        'id' => $troopId,
                    ],
                    'member' => [
                        'source' => 'scoutnet',
                        'id' => $memberId,
                    ],
                ];
            }

            foreach ($member->getPatrols() as $patrolId => $patrol) {
                $patrolMemberId = "$patrolId-$memberId";

                if (isset($patrols[$patrolId])) {
                    if (!isset($patrols[$patrolId]['name']) && isset($patrol['name'])) {
                        $patrols[$patrolId]['name'] = $patrol['name'];
                        $patrols[$patrolId]['troop'] = [
                            'source' => 'scoutnet',
                            'id' => intval($member->unit->rawValue)
                        ];
                    }
                } else {
                    $patrols[$patrolId] = [
                        'base' => [
                            'name' => isset($patrol['name']) ? $patrol['name'] : null,
                        ],
                        'troop' => isset($patrol['name']) ? [
                            'source' => 'scoutnet',
                            'id' => intval($member->unit->rawValue)
                        ] : null,
                        'members' => []
                    ];
                }

                $patrols[$patrolId]['members'][] = [
                    'source' => 'scoutnet',
                    'id' => $patrolMemberId,
                    'target' => [
                        'source' => 'scoutnet',
                        'id' => intval($member->member_no->value),
                    ]
                ];

                $patrolmembers[$patrolMemberId] = [
                    'base' => [
                        'role' => isset($patrol['role']) ? $patrol['role'] : '',
                    ],
                    'patrol' => [
                        'source' => 'scoutnet',
                        'id' => $patrolId,
                    ],
                    'member' => [
                        'source' => 'scoutnet',
                        'id' => $memberId,
                    ],
                ];
            }

            foreach ($member->getRoleGroups() as $roleGroupId => $roleGroup) {
                if (!isset($this->rolegroups[$roleGroupId])) {
                    $this->rolegroups[$roleGroupId] = [
                        'base' => [
                            'rolename' => $roleGroup['name']
                        ],
                        'members' => []
                    ];
                }
                $this->roleGroups[$roleGroupId]['members'][] = [
                    'source' => 'scoutnet',
                    'id' => $memberId
                ];
                $this->members[$memberId]['rolegroups'][] = [
                    'source' => 'scoutnet',
                    'id' => $roleGroupId
                ];
                $this->scoutgroups[$groupId]['rolegroups'][] = [
                    'source' => 'scoutnet',
                    'id' => $roleGroupId
                ];
            }
        }
        echo "itarated through memberlist in " . (\microtime(true) - $t) . " seconds\n";

        foreach ($patrols as $patrolId => $patrol) {
            if (isset($patrol['base']['name'])) {
                $this->patrols[$patrolId] = $patrol;
                $troops[$patrol['troop']['id']]['patrols'][] = [
                    'source' => 'scoutnet',
                    'id' => $patrolId,
                ];
                foreach ($patrol['members'] as $patrolmember) {
                    $this->members['patrols'][] = [
                        'source' => 'scoutnet',
                        'id' => $patrolmember['id'],
                        'target' => [
                            'source' => 'scoutnet',
                            'id' => $patrolId
                        ]
                    ];
                    $this->patrolMembers[$patrolmember['id']] = $patrolmembers[$patrolmember['id']];
                }
            }
        }

        foreach ($troops as $troopId => $troop) {
            if (isset($troop['base']['name'])) {
                $this->troops[$troopId] = $troop;
                foreach ($troop['members'] as $troopmember) {
                    $this->members['troops'][] = [
                        'source' => 'scoutnet',
                        'id' => $troopmember['id'],
                        'target' => [
                            'source' => 'scoutnet',
                            'id' => $troopId
                        ]
                    ];
                    $this->troopMembers[$troopmember['id']] = $troopmembers[$troopmember['id']];
                }
                $this->scoutgroups[$groupId]['troops'][] = [
                    'source' => 'scoutnet',
                    'id' => $troopId
                ];
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

        $customlists = $this->controllers[$groupId]->getCustomLists();

        foreach ($customlists as $customListId => $customList) {
            $this->customLists[$customListId] = [
                'base' => [
                    'title' => $customList->title,
                    'description' => $customList->description
                ],
                'members' => [],
                'sublists' => []
            ];
            foreach ($customList->rules as $ruleId => $rule) {
                $ruleListId = "$customListId-$ruleId";
                $this->customLists[$ruleListId] = [
                    'base' => [
                        'title' => $rule->title,
                        'description' => ''
                    ],
                    'members' => null,
                    'sublists' => []
                ];
                $this->customLists[$customListId]['sublists'][] = [
                    'source' => 'scoutnet',
                    'id' => $ruleListId
                ];
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
            $this->customLists[$customListId]['members'][] = [
                'source' => 'scoutnet',
                'id' => intval($member->member_no->value)
            ];
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
                'base' => [
                    'personinfo' => $waitingMember->getPersonInfo(),
                    'contactinfo' => $waitingMember->getContactInfo(),
                    'home' => $waitingMember->getHome(),
                    'waitingstartdate' => $waitingMember->waiting_since->value,
                    'note' => $waitingMember->note->value,
                    'leaderinterest' => boolval($waitingMember->contact_leader_interest->value)
                ],
                'contacts' => []
            ];

            foreach ($waitingMember->getContacts() as $contactId => $contact) {
                $this->contacts[$contactId] = [
                    'base' => $contact
                ];
                $this->waitingMembers[$memberId]['contacts'][] = [
                    'source' => 'scoutnet',
                    'id' => $contactId
                ];
            }
        }
    }
}
