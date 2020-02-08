<?php

namespace Scouterna\Scoutorg\Lib\Arrays;

use Scouterna\Scoutorg\Lib;

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
