<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;
use Scoutorg\Builder\Configs;

class ScoutGroupBuilder extends ObjectBuilder
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg);
    }

    public function build($source, $id)
    {
        $builder = $this->config['builders'][$source];
        /** @var Configs\ScoutGroupBase $base */
        $base = $builder($source, $id, 'base');

        $members = $this->buildList('members', Lib\Member::class, $source, $id);
        $troops = $this->buildList('troops', Lib\Troop::class, $source, $id);
        $branches = $this->buildList('branches', Lib\Branch::class, $source, $id);
        $groupRoles = $this->buildList('grouproles', Lib\GroupRole::class, $source, $id);
        $customLists = $this->buildList('customlists', Lib\CustomList::class, $source, $id);
        $waitingList = $this->buildList('waitingmembers', Lib\WaitingMember::class, $source, $id);

        return new Lib\ScoutGroup(
            $source,
            $id,
            $base->name,
            $members,
            $troops,
            $branches,
            $groupRoles,
            $customLists,
            $waitingList
        );
    }
}
