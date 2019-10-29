<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;
use Scoutorg\Builder\Configs;

class ScoutGroupBuilder extends ObjectBuilder
{
    public function __construct($config, $source, $id, $scoutorg)
    {
        parent::__construct($config, $source, $id, $scoutorg);
    }
    
    public function build()
    {
        $builder = $this->builder;
        /** @var Configs\ScoutGroupBase $base */
        $base = $builder($this->source, $this->id, 'base');

        $members = $this->buildList('members', 'member');
        $troops = $this->buildList('troops', 'troop');
        $branches = $this->buildList('branches', 'branch');
        $roleGroups = $this->buildList('rolegroups', 'rolegroup');
        $customLists = $this->buildList('customlists', 'customlist');
        $waitingList = $this->buildList('waitingmembers', 'waitingmember');

        return new Lib\ScoutGroup(
            $this->source,
            $this->id,
            $base->name,
            $members,
            $troops,
            $branches,
            $roleGroups,
            $customLists,
            $waitingList
        );
    }
}
