<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder\Bases;
use Scouterna\Scoutorg\Model\ScoutGroup;

class ScoutGroupTable extends BuilderTable
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg, Bases\ScoutGroupBase::class);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @return ScoutGroup 
     * @throws \OutOfRangeException 
     */
    public function get($uid)
    {
        return parent::get($uid);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @param Bases\ScoutGroupBase $base 
     * @return ScoutGroup 
     */
    protected function build($uid, $base)
    {
        $branches = $this->promiseList($uid, 'branches', Bases\BranchBase::class);
        $troops = $this->promiseList($uid, 'troops', Bases\TroopBase::class);
        $members = $this->promiseList($uid, 'members', Bases\MemberBase::class);
        $groupRoles = $this->promiseList($uid, 'grouproles', Bases\GroupRoleBase::class);
        $troopRoles = $this->promiseList($uid, 'trooproles', Bases\TroopRoleBase::class);
        $patrolRoles = $this->promiseList($uid, 'patrolroles', Bases\PatrolRoleBase::class);
        $customLists = $this->promiseList($uid, 'customlists', Bases\CustomListBase::class);
        $waitingList = $this->promiseList($uid, 'waitinglist', Bases\GroupWaiterBase::class);

        return new ScoutGroup(
            $uid,
            $base->getName(),
            $members,
            $troops,
            $branches,
            $groupRoles,
            $troopRoles,
            $patrolRoles,
            $customLists,
            $waitingList
        );
    }
}
