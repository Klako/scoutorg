<?php

namespace Scoutorg\Lib\Arrays;

use Scoutorg\Lib;

class GroupWaiterArray extends Lib\OrgArray
{
    public function get(string $source, $id): Lib\GroupWaiter
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source 
     * @return \Generator<string,Lib\GroupWaiter> 
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
