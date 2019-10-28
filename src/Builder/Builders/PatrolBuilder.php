<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;

class PatrolBuilder extends ObjectBuilder
{
    public function __construct($config, $source, $id, $scoutorg)
    {
        parent::__construct($config, $source, $id, $scoutorg);
    }
    public function build()
    {
        $builder = $this->builder;
        $patrol = $builder($this->source, $this->id, 'base');

        $troop = $this->buildSingle('troop', 'troop');
        $members = $this->buildList('members', 'patrolmember', true);

        return new Lib\Patrol(
            $this->source,
            $this->id,
            $patrol['name'],
            $troop,
            $members
        );
    }
}