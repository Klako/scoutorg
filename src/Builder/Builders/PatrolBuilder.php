<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;
use Scoutorg\Builder\Configs;

class PatrolBuilder extends ObjectBuilder
{
    public function __construct($config, $source, $id, $scoutorg)
    {
        parent::__construct($config, $source, $id, $scoutorg);
    }
    public function build()
    {
        $builder = $this->builder;
        /** @var Configs\PatrolBase $base */
        $base = $builder($this->source, $this->id, 'base');

        $troop = $this->buildSingle('troop', 'troop');
        $members = $this->buildLinkList('members', 'patrolmember');

        return new Lib\Patrol(
            $this->source,
            $this->id,
            $base->name,
            $troop,
            $members
        );
    }
}