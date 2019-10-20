<?php

namespace Scoutorg\Lib;

class CustomListArray extends OrgArray
{
    /** 
     * @return CustomList
     */
    public function get($source, $id) {
        return parent::get($source, $id);
    }
}