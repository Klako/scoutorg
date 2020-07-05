<?php

namespace Scouterna\Scoutorg\Lib\Arrays;

use Scouterna\Scoutorg\Lib;

class MemberArray extends Lib\OrgArray
{
    /** 
     * @return Lib\Member
     */
    public function get(string $source, $id): ?Lib\Member
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
