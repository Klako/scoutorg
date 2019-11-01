<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;
use Scoutorg\Builder\Configs;

class TroopMemberBuilder extends ObjectBuilder
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg);
    }

    public function build($source, $id)
    {
        $builder = $this->config['builders'][$source];
        /** @var Configs\TroopMemberBase $base */
        $base = $builder($source, $id, 'base');

        $troop = $this->buildSingle('troop', Lib\Troop::class, $source, $id);
        $member = $this->buildSingle('member', Lib\Member::class, $source, $id);

        return new Lib\TroopMember(
            $source,
            $id,
            $troop,
            $member,
            $base->role
        );
    }
}
