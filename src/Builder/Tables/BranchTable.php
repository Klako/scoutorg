<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder\Bases;
use Scouterna\Scoutorg\Model\Branch;

class BranchTable extends BuilderTable
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg, Bases\BranchBase::class);
    }

    /**
     * @return Branch
     * @throws \OutOfRangeException 
     */
    public function get($uid)
    {
        return parent::get($uid);
    }

    /**
     * @param Bases\BranchBase $base 
     * @return Branch 
     */
    protected function build($uid, $base)
    {
        $troops = $this->promiseList($uid, 'troops', Bases\TroopBase::class);

        return new Branch(
            $uid,
            $base->getName(),
            $troops
        );
    }
}
