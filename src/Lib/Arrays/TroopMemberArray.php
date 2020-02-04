<?php

namespace Scoutorg\Lib\Arrays;

use Scoutorg\Lib;

class TroopMemberArray extends Lib\OrgArray
{
    /** 
     * @return Lib\TroopMember
     */
    public function get(string $source, $id): Lib\TroopMember
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Lib\TroopMember>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
