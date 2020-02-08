<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder\Bases;
use Scouterna\Scoutorg\Lib\Branch;

class BranchTable extends BuilderTable
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg, Bases\BranchBase::class);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @return Branch
     * @throws \OutOfRangeException 
     */
    public function get($source, $id)
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @param Bases\BranchBase $base 
     * @return Branch 
     */
    protected function build($source, $id, $base)
    {
        $troops = $this->promiseList($source, $id, 'troops', Bases\TroopBase::class);

        return new Branch(
            $source,
            $id,
            $base->getName(),
            $troops
        );
    }
}
