<?php

namespace Scoutorg\Builder;

use Scoutorg\Lib;
use Scoutorg\Builder\Builders;

class ScoutorgBuilder
{
    private $config;

    /** @var Lib\MutableOrgArray<mixed,Lib\ScoutGroup> */
    private $groups;
    /** @var Lib\MutableOrgArray<mixed,Lib\Troop> */
    private $troops;
    /** @var Lib\MutableOrgArray<mixed,Lib\Branch> */
    private $branches;
    /** @var Lib\MutableOrgArray<mixed,Lib\Patrol> */
    private $patrols;
    /** @var Lib\MutableOrgArray<mixed,Lib\Member> */
    private $members;
    /** @var Lib\MutableOrgArray<mixed,Lib\CustomList> */
    private $customlists;
    /** @var Lib\MutableOrgArray<mixed,Lib\WaitingMember> */
    private $waitingmembers;
    /** @var Lib\MutableOrgArray<mixed,Lib\Contact> */
    private $contacts;
    /** @var Lib\MutableOrgArray<mixed,Lib\RoleGroup> */
    private $rolegroups;

    /** @var Lib\MutableOrgArray<mixed,Lib\TroopMember> */
    private $troopmembers;
    /** @var Lib\MutableOrgArray<mixed,Lib\PatrolMember> */
    private $patrolmembers;

    private $types;

    public function __construct($config)
    {
        $this->config = $config;
        $this->groups = new MutableOrgArray([]);
        $this->troops = new MutableOrgArray([]);
        $this->branches = new MutableOrgArray([]);
        $this->patrols = new MutableOrgArray([]);
        $this->members = new MutableOrgArray([]);
        $this->customlists = new MutableOrgArray([]);
        $this->waitingmembers = new MutableOrgArray([]);
        $this->contacts = new MutableOrgArray([]);
        $this->rolegroups = new MutableOrgArray([]);
        $this->troopmembers = new MutableOrgArray([]);
        $this->patrolmembers = new MutableOrgArray([]);
        $this->types = [
            'scoutgroup' => [
                'table' => $this->groups,
                'buildertype' => Builders\ScoutGroupBuilder::class
            ],
            'troop' => [
                'table' => $this->troops,
                'buildertype' => Builders\TroopBuilder::class
            ],
            'branch' => [
                'table' => $this->branches,
                'buildertype' => Builders\BranchBuilder::class
            ],
            'patrol' => [
                'table' => $this->patrols,
                'buildertype' => Builders\PatrolBuilder::class
            ],
            'member' => [
                'table' => $this->members,
                'buildertype' => Builders\MemberBuilder::class
            ],
            'customlist' => [
                'table' => $this->customlists,
                'buildertype' => Builders\CustomListBuilder::class
            ],
            'rolegroup' => [
                'table' => $this->rolegroups,
                'buildertype' => Builders\RoleGroupBuilder::class
            ],
            'contact' => [
                'table' => $this->contacts,
                'buildertype' => Builders\ContactBuilder::class
            ],
            'waitingmember' => [
                'table' => $this->waitingmembers,
                'buildertype' => Builders\WaitingMemberBuilder::class
            ],
            'troopmember' => [
                'table' => $this->troopmembers,
                'buildertype' => Builders\TroopMemberBuilder::class
            ],
            'patrolmember' => [
                'table' => $this->patrolmembers,
                'buildertype' => Builders\PatrolMemberBuilder::class
            ],
        ];
    }

    public function get($type, $source, $id)
    {
        assert(
            \in_array($type, \array_keys($this->types)),
            new \InvalidArgumentException("$type is not a scoutorg object type")
        );

        $table = $this->types[$type]['table'];
        if (!$table->exists($source, $id)) {
            $builderType = $this->types[$type]['buildertype'];

            /** @var ObjectBuilder $builder */
            $builder = new $builderType($this->config[$type], $source, $id, $this);

            // TODO: error on null

            $table->insert($builder->build());
        }

        return $table->get($source, $id);
    }
}