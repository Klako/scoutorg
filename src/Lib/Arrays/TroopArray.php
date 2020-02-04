<?php

namespace Scoutorg\Lib\Arrays;

use Scoutorg\Lib;

class TroopArray extends Lib\OrgArray
{
    /** 
     * @return Lib\Troop
     */
    public function get(string $source, $id): Lib\Troop
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Lib\Troop>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
