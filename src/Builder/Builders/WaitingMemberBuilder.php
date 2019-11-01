<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;
use Scoutorg\Builder\Configs;

class WaitingMemberBuilder extends ObjectBuilder
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg);
    }

    public function build($source, $id)
    {
        $builder = $this->config['builders'][$source];
        /** @var Configs\WaitingMemberBase $base */
        $waitingmember = $builder($source, $id, 'base');

        $contacts = $this->buildList('contacts', Lib\WaitingMember::class, $source, $id);

        return new Lib\WaitingMember(
            $source,
            $id,
            $base->personInfo,
            $base->contactInfo,
            $base->home,
            $contacts,
            $base->waitingStartdate,
            $base->note,
            $base->leaderInterest
        );
    }
}
