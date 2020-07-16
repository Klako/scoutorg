<?php

namespace Scouterna\Scoutorg\Model\Arrays;

use Scouterna\Scoutorg\Model;

class GroupRoleArray extends Model\OrgArray
{
    /** 
     * @return Model\GroupRole
     */
    public function get(Model\Uid $uid): ?Model\GroupRole
    {
        return parent::get($uid);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Model\GroupRole>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
