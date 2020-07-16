<?php

namespace Scouterna\Scoutorg\Model\Arrays;

use Scouterna\Scoutorg\Model;

class ScoutGroupArray extends Model\OrgArray
{
    /** 
     * @return Model\ScoutGroup
     */
    public function get(Model\Uid $uid): ?Model\ScoutGroup
    {
        return parent::get($uid);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Model\ScoutGroup>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
