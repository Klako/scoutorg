<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder\Bases\PatrolRoleBase;
use Scouterna\Scoutorg\Model\PatrolRole;

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
    public function get($uid)
    {
        return parent::get($uid);
    }

    /**
     * 
     * @param string $source 
     * @param int|string $id 
     * @param PatrolRoleBase $base 
     * @return PatrolRole
     */
    protected function build($uid, $base)
    {
        return new PatrolRole($uid, $base->getName());
    }
}
