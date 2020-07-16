<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder\Bases\GroupRoleBase;
use Scouterna\Scoutorg\Builder\Bases\GroupWaiterBase;
use Scouterna\Scoutorg\Builder\Bases\MemberBase;
use Scouterna\Scoutorg\Builder\Bases\ScoutGroupBase;
use Scouterna\Scoutorg\Model\GroupWaiter;

class GroupWaiterTable extends BuilderTable
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg, GroupRoleBase::class);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @return GroupWaiter 
     * @throws \OutOfRangeException 
     */
    public function get($uid)
    {
        return parent::get($uid);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @param GroupWaiterBase $base 
     * @return GroupWaiter 
     */
    protected function build($uid, $base)
    {
        $group = $this->promiseLink($uid, 'group', ScoutGroupBase::class);
        $member = $this->promiseLink($uid, 'member', MemberBase::class);

        return new GroupWaiter(
            $uid->getSource(),
            $uid->getId(),
            $base->getWaitingSince(),
            $group,
            $member
        );
    }
}
