<?php

namespace Scoutorg\Lib;

class PatrolMemberArray extends OrgArray
{
    /** 
     * @return PatrolMember
     */
    public function get($source, $id) {
        return parent::get($source, $id);
    }
}