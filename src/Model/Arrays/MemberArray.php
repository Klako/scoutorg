<?php

namespace Scouterna\Scoutorg\Model\Arrays;

use Scouterna\Scoutorg\Model;

class MemberArray extends Model\OrgArray
{
    /** 
     * @return Model\Member
     */
    public function get(Model\Uid $uid): ?Model\Member
    {
        return parent::get($uid);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Model\Member>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
