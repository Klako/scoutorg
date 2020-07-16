<?php

namespace Scouterna\Scoutorg\Model\Arrays;

use Scouterna\Scoutorg\Model;

class GroupMemberArray extends Model\OrgArray
{
    /**
     * @return Model\GroupMember 
     */
    public function get(Model\Uid $uid): ?Model\GroupMember
    {
        return parent::get($uid);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Model\GroupMember>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}