<?php

namespace Scouterna\Scoutorg\Model\Arrays;

use Scouterna\Scoutorg\Model;

class TroopArray extends Model\OrgArray
{
    /** 
     * @return Model\Troop
     */
    public function get(Model\Uid $uid): ?Model\Troop
    {
        return parent::get($uid);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Model\Troop>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
