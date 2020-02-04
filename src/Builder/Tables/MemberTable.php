<?php

namespace Scoutorg\Builder\Tables;

use Scoutorg\Builder\Bases;
use Scoutorg\Lib\Member;

class MemberTable extends BuilderTable
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg, Bases\MemberBase::class);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @return Member 
     * @throws \OutOfRangeException 
     */
    public function get($source, $id)
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @param Bases\MemberBase $base 
     * @return Member 
     */
    protected function build($source, $id, $base)
    {
        $contacts = $this->promiseList($source, $id, 'contacts', Bases\ContactBase::class);
        $troops = $this->promiseEdgeList($source, $id, 'troops', Bases\TroopBase::class, Bases\TroopMemberBase::class);
        $patrols = $this->promiseEdgeList($source, $id, 'patrols', Bases\PatrolBase::class, Bases\PatrolMemberBase::class);
        $groups = $this->promiseEdgeList($source, $id, 'groups', Bases\ScoutGroupBase::class, Bases\GroupMemberBase::class);
        $waitGroups = $this->promiseEdgeList($source, $id, 'waitgroups', Bases\ScoutGroupBase::class, Bases\GroupWaiterBase::class);

        return new Member(
            $source,
            $id,
            $base->getPersonInfo(),
            $base->getContactInfo(),
            $base->getHome(),
            $base->getNote(),
            $base->getLeaderInterest(),
            $contacts,
            $troops,
            $patrols,
            $groups,
            $waitGroups
        );
    }
}
