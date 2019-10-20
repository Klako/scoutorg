<?php

namespace Scoutorg\Lib;

class BranchArray extends OrgArray
{
    /** 
     * @return Branch
     */
    public function get($source, $id) {
        return parent::get($source, $id);
    }
}