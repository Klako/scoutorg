<?php

namespace Scoutorg\Builder\Tables;

use Scoutorg\Builder\Bases\MemberBase;
use Scoutorg\Builder\Bases\PatrolBase;
use Scoutorg\Builder\Bases\PatrolMemberBase;
use Scoutorg\Builder\Bases\TroopBase;
use Scoutorg\Lib\OrgObject;
use Scoutorg\Lib\Patrol;

class PatrolTable extends BuilderTable
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg, PatrolBase::class);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @return Patrol 
     * @throws \OutOfRangeException 
     */
    public function get($source, $id)
    {
        return parent::get($source, $id);
    }

    /**
     * 
     * @param string $source 
     * @param int|string $id 
     * @param PatrolBase $base 
     * @return Patrol 
     */
    protected function build($source, $id, $base)
    {
        $troop = $this->promiseLink($source, $id, 'troop', TroopBase::class);
        $members = $this->promiseEdgeList($source, $id, 'members', MemberBase::class, PatrolMemberBase::class);

        return new Patrol(
            $source,
            $id,
            $base->getName(),
            $troop,
            $members
        );
    }
}
