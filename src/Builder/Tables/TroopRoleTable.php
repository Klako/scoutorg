<?php

namespace Scoutorg\Builder\Tables;

use Scoutorg\Builder\Bases\TroopRoleBase;
use Scoutorg\Lib\OrgObject;
use Scoutorg\Lib\TroopRole;

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
    public function get($source, $id)
    {
        return parent::get($source, $id);
    }
    
    /**
     * @param string $source 
     * @param int|string $id 
     * @param TroopRoleBase $base 
     * @return TroopRole
     */
    protected function build($source, $id, $base)
    {
        return new TroopRole($source, $id, $base->getName());
    }
}
