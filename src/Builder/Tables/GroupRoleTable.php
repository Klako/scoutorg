<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder\Bases\GroupRoleBase;
use Scouterna\Scoutorg\Model\GroupRole;

class GroupRoleTable extends BuilderTable
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg, GroupRoleBase::class);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @return GroupRole 
     * @throws \OutOfRangeException 
     */
    public function get($uid)
    {
        return parent::get($uid);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @param GroupRoleBase $base 
     * @return GroupRole 
     */
    protected function build($uid, $base)
    {
        return new GroupRole($uid->getSource(), $uid->getId(), $base->getName());
    }
}
