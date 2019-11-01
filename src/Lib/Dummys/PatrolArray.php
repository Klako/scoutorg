<?php

namespace Scoutorg\Lib\Dummys;

use Scoutorg\Lib;

class PatrolArray extends OrgArray
{
    /** 
     * @return Patrol
     */
    public function get($source, $id) {
        return parent::get($source, $id);
    }
}