<?php

namespace Scoutorg\Lib\Dummies;

use Scoutorg\Lib;

class WaitingMemberArray extends OrgArray
{
    /** 
     * @return WaitingMember
     */
    public function get($source, $id) {
        return parent::get($source, $id);
    }
}