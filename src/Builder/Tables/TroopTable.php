<?php

namespace Scoutorg\Builder\Tables;

use Scoutorg\Builder\Bases\BranchBase;
use Scoutorg\Builder\Bases\MemberBase;
use Scoutorg\Builder\Bases\PatrolBase;
use Scoutorg\Builder\Bases\TroopBase;
use Scoutorg\Builder\Bases\TroopMemberBase;
use Scoutorg\Lib\OrgObject;
use Scoutorg\Lib\Troop;

class TroopTable extends BuilderTable
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg, TroopBase::class);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @return Troop 
     * @throws \OutOfRangeException 
     */
    public function get($source, $id)
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @param TroopBase $base 
     * @return Troop 
     */
    protected function build($source, $id, $base)
    {
        $branch = $this->promiseLink($source, $id, 'branch', BranchBase::class);
        $patrols = $this->promiseList($source, $id, 'patrols', PatrolBase::class);
        $members = $this->promiseEdgeList($source, $id, 'members', MemberBase::class, TroopMemberBase::class);

        return new Troop(
            $source,
            $id,
            $base->getName(),
            $branch,
            $members,
            $patrols
        );
    }
}
