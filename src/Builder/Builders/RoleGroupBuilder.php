<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;
use Scoutorg\Builder\Configs;

class RoleGroupBuilder extends ObjectBuilder
{
    public function __construct($config, $source, $id, $scoutorg)
    {
        parent::__construct($config, $source, $id, $scoutorg);
    }

    public function build()
    {
        $builder = $this->builder;
        /** @var Configs\RoleGroupBase $base */
        $base = $builder($this->source, $this->id, 'base');

        $members = $this->buildList('members', 'member');

        return new Lib\RoleGroup(
            $this->source,
            $this->id,
            $base->rolename,
            $members
        );
    }
}
