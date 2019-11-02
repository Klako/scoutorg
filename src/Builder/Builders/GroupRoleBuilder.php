<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;
use Scoutorg\Builder\Configs;

class GroupRoleBuilder extends ObjectBuilder
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg);
    }

    public function build($source, $id)
    {
        $builder = $this->config['builders'][$source];
        /** @var Configs\GroupRoleBase $base */
        $base = $builder($source, $id, 'base');

        $members = $this->buildList('members', Lib\Member::class, $source, $id);

        return new Lib\GroupRole(
            $source,
            $id,
            $base->rolename,
            $members
        );
    }
}
