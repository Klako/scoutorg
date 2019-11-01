<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;
use Scoutorg\Builder\Configs;

class PatrolMemberBuilder extends ObjectBuilder
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg);
    }

    public function build($source, $id)
    {
        $builder = $this->config['builders'][$source];
        /** @var Configs\PatrolMemberBase $base */
        $base = $builder($source, $id, 'base');

        $patrol = $this->buildSingle('patrol', Lib\Patrol::class, $source, $id);
        $member = $this->buildSingle('member', Lib\Member::class, $source, $id);

        return new Lib\PatrolMember(
            $source,
            $id,
            $patrol,
            $member,
            $base->role
        );
    }
}