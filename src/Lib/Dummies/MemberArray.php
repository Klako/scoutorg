<?php

namespace Scoutorg\Lib\Dummies;

use Scoutorg\Lib;

class MemberArray extends OrgArray
{
    /** 
     * @return Member
     */
    public function get($source, $id) {
        return parent::get($source, $id);
    }
}