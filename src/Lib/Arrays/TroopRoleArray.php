<?php

namespace Scoutorg\Lib\Arrays;

use Scoutorg\Lib;

class TroopRoleArray extends Lib\OrgArray
{
    /** 
     * @return Lib\TroopRole
     */
    public function get(string $source, $id): Lib\TroopRole
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Lib\TroopRole>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
