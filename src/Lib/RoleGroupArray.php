<?php

namespace Scoutorg\Lib;

class RoleGroupArray extends OrgArray
{
    /** 
     * @return RoleGroup
     */
    public function get($source, $id) {
        return parent::get($source, $id);
    }
}