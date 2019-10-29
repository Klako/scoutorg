<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;
use Scoutorg\Builder\Configs;

class TroopMemberBuilder extends ObjectBuilder
{
    public function __construct($config, $source, $id, $scoutorg)
    {
        parent::__construct($config, $source, $id, $scoutorg);
    }

    public function build()
    {
        $builder = $this->builder;
        /** @var Configs\TroopMemberBase $base */
        $base = $builder($this->source, $this->id, 'base');

        $troop = $this->buildSingle('troop', 'troop');
        $member = $this->buildSingle('member', 'member');

        return new Lib\TroopMember(
            $this->source,
            $this->id,
            $troop,
            $member,
            $base->role
        );
    }
}