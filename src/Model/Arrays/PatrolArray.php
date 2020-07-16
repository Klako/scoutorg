<?php

namespace Scouterna\Scoutorg\Model\Arrays;

use Scouterna\Scoutorg\Model;

class PatrolArray extends Model\OrgArray
{
    /** 
     * @return Model\Patrol
     */
    public function get(Model\Uid $uid): ?Model\Patrol
    {
        return parent::get($uid);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Model\Patrol>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
