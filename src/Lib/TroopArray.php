<?php

namespace Scoutorg\Lib;

class TroopArray extends OrgArray
{
    /** 
     * @return Troop
     */
    public function get($source, $id) {
        return parent::get($source, $id);
    }
}