<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder\Bases\PatrolRoleBase;
use Scouterna\Scoutorg\Lib\PatrolRole;

class PatrolRoleTable extends BuilderTable
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg, PatrolRoleBase::class);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @return PatrolRole 
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
     * @param PatrolRoleBase $base 
     * @return PatrolRole
     */
    protected function build($source, $id, $base)
    {
        return new PatrolRole($source, $id, $base->getName());
    }
}
