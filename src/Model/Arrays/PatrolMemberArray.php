<?php

namespace Scouterna\Scoutorg\Model\Arrays;

use Scouterna\Scoutorg\Model;

class PatrolMemberArray extends Model\OrgArray
{
    /** 
     * @return Model\PatrolMember
     */
    public function get(Model\Uid $uid): ?Model\PatrolMember
    {
        return parent::get($uid);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Model\PatrolMember>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
