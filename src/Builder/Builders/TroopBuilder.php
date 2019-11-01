<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;
use Scoutorg\Builder\Configs;

class TroopBuilder extends ObjectBuilder
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg);
    }

    public function build($source, $id)
    {
        $builder = $this->config['builders'][$source];
        /** @var Configs\TroopBase $base */
        $base = $builder($source, $id, 'base');

        $branch = $this->buildSingle('branch', Lib\Branch::class, $source, $id);
        $members = $this->buildLinkList('members', Lib\TroopMember::class, $source, $id);
        $patrols = $this->buildList('patrols', Lib\Patrol::class, $source, $id);

        return new Lib\Troop(
            $source,
            $id,
            $base->name,
            $branch,
            $members,
            $patrols
        );
    }
}