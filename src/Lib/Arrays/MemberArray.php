<?php

namespace Scoutorg\Lib\Arrays;

use Scoutorg\Lib;

class MemberArray extends Lib\OrgArray
{
    /** 
     * @return Lib\Member
     */
    public function get(string $source, $id): Lib\Member
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Lib\Member>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
