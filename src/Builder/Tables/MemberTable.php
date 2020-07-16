<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder\Bases;
use Scouterna\Scoutorg\Model\Member;

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
    public function get($uid)
    {
        return parent::get($uid);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @param Bases\MemberBase $base 
     * @return Member 
     */
    protected function build($uid, $base)
    {
        $contacts = $this->promiseList($uid, 'contacts', Bases\ContactBase::class);
        $troops = $this->promiseEdgeList($uid, 'troops', Bases\TroopBase::class, Bases\TroopMemberBase::class);
        $patrols = $this->promiseEdgeList($uid, 'patrols', Bases\PatrolBase::class, Bases\PatrolMemberBase::class);
        $groups = $this->promiseEdgeList($uid, 'groups', Bases\ScoutGroupBase::class, Bases\GroupMemberBase::class);
        $waitGroups = $this->promiseEdgeList($uid, 'waitgroups', Bases\ScoutGroupBase::class, Bases\GroupWaiterBase::class);

        return new Member(
            $uid->getSource(),
            $uid->getId(),
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
