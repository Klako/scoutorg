<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder\Bases\MemberBase;
use Scouterna\Scoutorg\Builder\Bases\PatrolBase;
use Scouterna\Scoutorg\Builder\Bases\PatrolMemberBase;
use Scouterna\Scoutorg\Builder\Bases\TroopBase;
use Scouterna\Scoutorg\Model\Patrol;

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
    public function get($uid)
    {
        return parent::get($uid);
    }

    /**
     * 
     * @param string $source 
     * @param int|string $id 
     * @param PatrolBase $base 
     * @return Patrol 
     */
    protected function build($uid, $base)
    {
        $troop = $this->promiseLink($uid, 'troop', TroopBase::class);
        $members = $this->promiseEdgeList($uid, 'members', MemberBase::class, PatrolMemberBase::class);

        return new Patrol(
            $uid->getSource(),
            $uid->getId(),
            $base->getName(),
            $troop,
            $members
        );
    }
}
