<?php

namespace Scouterna\Scoutorg\Model\Arrays;

use Scouterna\Scoutorg\Model;

class TroopRoleArray extends Model\OrgArray
{
    /** 
     * @return Model\TroopRole
     */
    public function get(Model\Uid $uid): ?Model\TroopRole
    {
        return parent::get($uid);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Model\TroopRole>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
