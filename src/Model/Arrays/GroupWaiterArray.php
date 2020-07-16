<?php

namespace Scouterna\Scoutorg\Model\Arrays;

use Scouterna\Scoutorg\Model;

class GroupWaiterArray extends Model\OrgArray
{
    public function get(string $source, $id): ?Model\GroupWaiter
    {
        return parent::get($source, $id);
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
