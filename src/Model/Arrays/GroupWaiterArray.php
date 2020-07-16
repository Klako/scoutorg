<?php

namespace Scouterna\Scoutorg\Model\Arrays;

use Scouterna\Scoutorg\Model;

class GroupWaiterArray extends Model\OrgArray
{
    public function get(Model\Uid $uid): ?Model\GroupWaiter
    {
        return parent::get($uid);
    }

    /**
     * @param string $source 
     * @return \Generator<string,Model\GroupWaiter> 
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
