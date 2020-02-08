<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder\Bases\GroupRoleBase;
use Scouterna\Scoutorg\Builder\Bases\GroupWaiterBase;
use Scouterna\Scoutorg\Builder\Bases\MemberBase;
use Scouterna\Scoutorg\Builder\Bases\ScoutGroupBase;
use Scouterna\Scoutorg\Lib\GroupWaiter;

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
    public function get($source, $id)
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @param GroupWaiterBase $base 
     * @return GroupWaiter 
     */
    protected function build($source, $id, $base)
    {
        $group = $this->promiseLink($source, $id, 'group', ScoutGroupBase::class);
        $member = $this->promiseLink($source, $id, 'member', MemberBase::class);

        return new GroupWaiter(
            $source,
            $id,
            $base->getWaitingSince(),
            $group,
            $member
        );
    }
}
