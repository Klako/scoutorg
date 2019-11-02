<?php

namespace Scoutorg\Lib\Dummies;

use Scoutorg\Lib;

class GroupRoleArray extends OrgArray
{
    /** 
     * @return GroupRole
     */
    public function get($source, $id) {
        return parent::get($source, $id);
    }
}