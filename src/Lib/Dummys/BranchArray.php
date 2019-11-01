<?php

namespace Scoutorg\Lib\Dummys;

use Scoutorg\Lib;

class BranchArray extends Lib\OrgArray
{
    /** 
     * @return Branch
     */
    public function get($source, $id) {
        return parent::get($source, $id);
    }
}