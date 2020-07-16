<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder\Bases\BranchBase;
use Scouterna\Scoutorg\Builder\Bases\MemberBase;
use Scouterna\Scoutorg\Builder\Bases\PatrolBase;
use Scouterna\Scoutorg\Builder\Bases\TroopBase;
use Scouterna\Scoutorg\Builder\Bases\TroopMemberBase;
use Scouterna\Scoutorg\Model\Troop;

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
    public function get($uid)
    {
        return parent::get($uid);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @param TroopBase $base 
     * @return Troop 
     */
    protected function build($uid, $base)
    {
        $branch = $this->promiseLink($uid, 'branch', BranchBase::class);
        $patrols = $this->promiseList($uid, 'patrols', PatrolBase::class);
        $members = $this->promiseEdgeList($uid, 'members', MemberBase::class, TroopMemberBase::class);

        return new Troop(
            $uid->getSource(),
            $uid->getId(),
            $base->getName(),
            $branch,
            $members,
            $patrols
        );
    }
}
