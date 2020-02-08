<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder\Bases\MemberBase;
use Scouterna\Scoutorg\Builder\Bases\PatrolBase;
use Scouterna\Scoutorg\Builder\Bases\PatrolMemberBase;
use Scouterna\Scoutorg\Builder\Bases\TroopBase;
use Scouterna\Scoutorg\Lib\Patrol;

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
