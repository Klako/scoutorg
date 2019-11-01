<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;
use Scoutorg\Builder\Configs;

class RoleGroupBuilder extends ObjectBuilder
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg);
    }

    public function build($source, $id)
    {
        $builder = $this->config['builders'][$source];
        /** @var Configs\RoleGroupBase $base */
        $base = $builder($source, $id, 'base');

        $members = $this->buildList('members', Lib\Member::class, $source, $id);

        return new Lib\RoleGroup(
            $source,
            $id,
            $base->rolename,
            $members
        );
    }
}
