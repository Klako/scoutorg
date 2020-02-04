<?php

namespace Scoutorg\Builder\Tables;

use Scoutorg\Builder\Bases\BranchBase;
use Scoutorg\Builder\Bases\CustomListBase;
use Scoutorg\Builder\Bases\GroupRoleBase;
use Scoutorg\Builder\Bases\MemberBase;
use Scoutorg\Builder\Bases\ScoutGroupBase;
use Scoutorg\Builder\Bases\TroopBase;
use Scoutorg\Builder\Bases\WaitingMemberBase;
use Scoutorg\Lib\OrgObject;
use Scoutorg\Lib\ScoutGroup;

class ScoutGroupTable extends BuilderTable
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg, ScoutGroupBase::class);
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
     * @param ScoutGroupBase $base 
     * @return ScoutGroup 
     */
    protected function build($source, $id, $base)
    {
        $branches = $this->promiseList($source, $id, 'branches', BranchBase::class);
        $troops = $this->promiseList($source, $id, 'troops', TroopBase::class);
        $members = $this->promiseList($source, $id, 'members', MemberBase::class);
        $customLists = $this->promiseList($source, $id, 'customlists', CustomListBase::class);
        $groupRoles = $this->promiseList($source, $id, 'grouproles', GroupRoleBase::class);
        $waitingList = $this->promiseList($source, $id, 'waitinglist', WaitingMemberBase::class);

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
