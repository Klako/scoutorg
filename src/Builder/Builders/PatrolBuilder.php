<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;
use Scoutorg\Builder\Configs;

class PatrolBuilder extends ObjectBuilder
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg);
    }
    
    public function build($source, $id)
    {
        $builder = $this->config['builders'][$source];
        /** @var Configs\PatrolBase $base */
        $base = $builder($source, $id, 'base');

        $troop = $this->buildSingle('troop', Lib\Troop::class, $source, $id);
        $members = $this->buildLinkList('members', Lib\PatrolMember::class, $source, $id);

        return new Lib\Patrol(
            $source,
            $id,
            $base->name,
            $troop,
            $members
        );
    }
}
