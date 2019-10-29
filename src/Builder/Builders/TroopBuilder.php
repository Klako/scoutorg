<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;
use Scoutorg\Builder\Configs;

class TroopBuilder extends ObjectBuilder
{
    public function __construct($config, $source, $id, $scoutorg)
    {
        parent::__construct($config, $source, $id, $scoutorg);
    }

    public function build()
    {
        $builder = $this->builder;
        /** @var Configs\TroopBase $base */
        $base = $builder($this->source, $this->id, 'base');

        $branch = $this->buildSingle('branch', 'branch');
        $members = $this->buildLinkList('members', 'troopmember');
        $patrols = $this->buildList('patrols', 'patrol');

        return new Lib\Troop(
            $this->source,
            $this->id,
            $base->name,
            $branch,
            $members,
            $patrols
        );
    }
}