<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;
use Scoutorg\Builder\Configs;

class WaitingMemberBuilder extends ObjectBuilder
{
    public function __construct($config, $source, $id, $scoutorg)
    {
        parent::__construct($config, $source, $id, $scoutorg);
    }

    public function build()
    {
        $builder = $this->builder;
        /** @var Configs\WaitingMemberBase $base */
        $waitingmember = $builder($this->source, $this->id, 'base');

        $contacts = $this->buildList('contacts', 'contact');

        return new Lib\WaitingMember(
            $this->source,
            $this->id,
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