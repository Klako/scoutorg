<?php

namespace Scouterna\Scoutorg\Model\Arrays;

use Scouterna\Scoutorg\Model;

class TroopMemberArray extends Model\OrgArray
{
    /** 
     * @return Model\TroopMember
     */
    public function get(Model\Uid $uid): ?Model\TroopMember
    {
        return parent::get($uid);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Model\TroopMember>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
