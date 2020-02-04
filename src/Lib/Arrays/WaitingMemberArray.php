<?php

namespace Scoutorg\Lib\Arrays;

use Scoutorg\Lib;

class WaitingMemberArray extends Lib\OrgArray
{
    /** 
     * @return WaitingMember
     */
    public function get(string $source, $id): Lib\WaitingMember
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Lib\WaitingMember>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
