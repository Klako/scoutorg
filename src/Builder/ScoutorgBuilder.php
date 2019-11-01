<?php

namespace Scoutorg\Builder;

use Scoutorg\Lib;
use Scoutorg\Builder\Builders;

class ScoutorgBuilder
{
    private $config;

    private $tables;

    public function __construct($config)
    {
        $this->config = $config;
        $this->setTable(Lib\ScoutGroup::class, Builders\ScoutGroupBuilder::class);
        $this->setTable(Lib\Troop::class, Builders\TroopBuilder::class);
        $this->setTable(Lib\Branch::class, Builders\BranchBuilder::class);
        $this->setTable(Lib\Patrol::class, Builders\PatrolBuilder::class);
        $this->setTable(Lib\Member::class, Builders\MemberBuilder::class);
        $this->setTable(Lib\CustomList::class, Builders\CustomListBuilder::class);
        $this->setTable(Lib\RoleGroup::class, Builders\RoleGroupBuilder::class);
        $this->setTable(Lib\Contact::class, Builders\ContactBuilder::class);
        $this->setTable(Lib\WaitingMember::class, Builders\WaitingMemberBuilder::class);
        $this->setTable(Lib\TroopMember::class, Builders\TroopMemberBuilder::class);
        $this->setTable(Lib\PatrolMember::class, Builders\PatrolMemberBuilder::class);
    }

    public function get($type, $source, $id)
    {
        assert(
            \in_array($type, \array_keys($this->tables)),
            new \InvalidArgumentException("$type is not a scoutorg object type")
        );

        $table = $this->tables[$type]->table;
        if (!$table->exists($source, $id)) {

            /** @var Builders\ObjectBuilder $builder */
            $builder = $this->tables[$type]->builder;

            $orgObject = $builder->build($source, $id);

            // TODO: error on null

            $table->insert($orgObject);
        }

        return $table->get($source, $id);
    }

    private function setTable($type, $builder) {
        $this->tables[$type] = (object)[
            'table' => new MutableOrgArray([]),
            'builder' => new $builder($this->config[$type], $this),
        ];
    }
}
