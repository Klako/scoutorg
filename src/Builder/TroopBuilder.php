<?php

namespace Scoutorg\Builder;

use Scoutorg\Lib;

class TroopBuilder extends ObjectBuilder
{
    public function __construct($config, $source, $id, $scoutorg)
    {
        parent::__construct($config, $source, $id, $scoutorg);
    }

    public function build()
    {
        $builder = $this->builder;
        $troop = $builder($this->id, 'base');

        $branch = $this->buildSingle('branch', 'branch');
        $members = $this->buildList('members', 'troopmember', true);
        $patrols = $this->buildList('patrols', 'patrol');

        return new Lib\Troop(
            $this->source,
            $this->id,
            $troop['name'],
            $branch,
            $members,
            $patrols
        );
    }
}