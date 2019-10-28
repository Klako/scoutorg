<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;

class WaitingMemberBuilder extends ObjectBuilder
{
    public function __construct($config, $source, $id, $scoutorg)
    {
        parent::__construct($config, $source, $id, $scoutorg);
    }

    public function build()
    {
        $builder = $this->builder;
        $waitingmember = $builder($this->source, $this->id, 'base');

        $contacts = $this->buildList('contacts', 'contact');

        return new Lib\WaitingMember(
            $this->source,
            $this->id,
            $waitingmember['personinfo'],
            $waitingmember['contactinfo'],
            $waitingmember['home'],
            $contacts,
            $waitingmember['waitingstartdate'],
            $waitingmember['note'],
            $waitingmember['leaderinterest']
        );
    }
}