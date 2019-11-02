<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;
use Scoutorg\Builder\Configs;

class MemberBuilder extends ObjectBuilder
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg);
    }

    public function build($source, $id)
    {
        $builder = $this->config['builders'][$source];
        /** @var Configs\MemberBase $base */
        $base = $builder($source, $id, 'base');

        $contacts = $this->buildList('contacts', Lib\Contact::class, $source, $id);
        $troops = $this->buildLinkList('troops', Lib\TroopMember::class, $source, $id);
        $patrols = $this->buildLinkList('patrols', Lib\PatrolMember::class, $source, $id);
        $grouproles = $this->buildList('grouproles', Lib\GroupRole::class, $source, $id);

        return new Lib\Member(
            $source,
            $id,
            $base->personInfo,
            $base->contactInfo,
            $base->home,
            $contacts,
            $base->startdate,
            $troops,
            $patrols,
            $grouproles
        );
    }
}
