<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;

class PatrolMemberBuilder extends ObjectBuilder
{
    public function __construct($config, $source, $id, $scoutorg)
    {
        parent::__construct($config, $source, $id, $scoutorg);
    }

    public function build()
    {
        $builder = $this->builder;
        $patrolmember = $builder($this->source, $this->id, 'base');

        $patrol = $this->buildSingle('patrol', 'patrol');
        $member = $this->buildSingle('member', 'member');

        return new Lib\PatrolMember(
            $this->source,
            $this->id,
            $patrol,
            $member,
            $patrolmember['role']
        );
    }
}