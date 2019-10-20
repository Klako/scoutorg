<?php

namespace Scoutorg\Builder;

use Scoutorg\Lib;

class MemberBuilder extends ObjectBuilder
{
    public function __construct($config, $source, $id, $scoutorg)
    {
        parent::__construct($config, $source, $id, $scoutorg);
    }
    
    public function build()
    {
        $builder = $this->builder;
        $member = $builder($this->id, 'base');

        $contacts = $this->buildList('contacts', 'contact');
        $troops = $this->buildList('troops', 'troopmember', true);
        $patrols = $this->buildList('patrols', 'patrolmember', true);
        $rolegroups = $this->buildList('rolegroups', 'rolegroup');

        return new Lib\Member(
            $this->source,
            $this->id,
            $member['personinfo'],
            $member['contactinfo'],
            $member['home'],
            $contacts,
            $member['startdate'],
            $troops,
            $patrols,
            $rolegroups
        );
    }
}