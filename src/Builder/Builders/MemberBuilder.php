<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;
use Scoutorg\Builder\Configs;

class MemberBuilder extends ObjectBuilder
{
    public function __construct($config, $source, $id, $scoutorg)
    {
        parent::__construct($config, $source, $id, $scoutorg);
    }
    
    public function build()
    {
        $builder = $this->builder;
        /** @var Configs\MemberBase $base */
        $base = $builder($this->source, $this->id, 'base');

        $contacts = $this->buildList('contacts', 'contact');
        $troops = $this->buildLinkList('troops', 'troopmember');
        $patrols = $this->buildLinkList('patrols', 'patrolmember');
        $rolegroups = $this->buildList('rolegroups', 'rolegroup');

        return new Lib\Member(
            $this->source,
            $this->id,
            $base->personInfo,
            $base->contactInfo,
            $base->home,
            $contacts,
            $base->startdate,
            $troops,
            $patrols,
            $rolegroups
        );
    }
}