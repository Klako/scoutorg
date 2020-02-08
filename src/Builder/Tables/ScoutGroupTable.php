<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder\Bases;
use Scouterna\Scoutorg\Lib\ScoutGroup;

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
    public function get($source, $id)
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @param Bases\ScoutGroupBase $base 
     * @return ScoutGroup 
     */
    protected function build($source, $id, $base)
    {
        $branches = $this->promiseList($source, $id, 'branches', Bases\BranchBase::class);
        $troops = $this->promiseList($source, $id, 'troops', Bases\TroopBase::class);
        $members = $this->promiseList($source, $id, 'members', Bases\MemberBase::class);
        $customLists = $this->promiseList($source, $id, 'customlists', Bases\CustomListBase::class);
        $groupRoles = $this->promiseList($source, $id, 'grouproles', Bases\GroupRoleBase::class);
        $waitingList = $this->promiseList($source, $id, 'waitinglist', Bases\GroupWaiterBase::class);

        return new ScoutGroup(
            $source,
            $id,
            $base->getName(),
            $members,
            $troops,
            $branches,
            $groupRoles,
            $customLists,
            $waitingList
        );
    }
}
