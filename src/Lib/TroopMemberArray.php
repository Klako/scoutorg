<?php

namespace Scoutorg\Lib;

class TroopMemberArray extends OrgArray
{
    /** 
     * @return TroopMember
     */
    public function get($source, $id) {
        return parent::get($source, $id);
    }
}