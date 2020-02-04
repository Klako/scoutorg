<?php

namespace Scoutorg\Lib\Arrays;

use Scoutorg\Lib;

class PatrolMemberArray extends Lib\OrgArray
{
    /** 
     * @return Lib\PatrolMember
     */
    public function get(string $source, $id): Lib\PatrolMember
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Lib\PatrolMember>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
