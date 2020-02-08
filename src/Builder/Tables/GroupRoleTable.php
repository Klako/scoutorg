<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder\Bases\GroupRoleBase;
use Scouterna\Scoutorg\Lib\GroupRole;

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
    public function get($source, $id)
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @param GroupRoleBase $base 
     * @return GroupRole 
     */
    protected function build($source, $id, $base)
    {
        return new GroupRole($source, $id, $base->getName());
    }
}
