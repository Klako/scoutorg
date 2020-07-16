<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder\Bases\TroopRoleBase;
use Scouterna\Scoutorg\Model\TroopRole;

class TroopRoleTable extends BuilderTable
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg, TroopRoleBase::class);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @return TroopRole 
     * @throws \OutOfRangeException 
     */
    public function get($uid)
    {
        return parent::get($uid);
    }
    
    /**
     * @param string $source 
     * @param int|string $id 
     * @param TroopRoleBase $base 
     * @return TroopRole
     */
    protected function build($uid, $base)
    {
        return new TroopRole($uid->getSource(), $uid->getId(), $base->getName());
    }
}
