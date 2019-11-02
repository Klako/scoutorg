<?php

namespace Scoutorg\Lib\Dummies;

use Scoutorg\Lib;

class ContactArray extends OrgArray
{
    /** 
     * @return Contact
     */
    public function get($source, $id) {
        return parent::get($source, $id);
    }
}