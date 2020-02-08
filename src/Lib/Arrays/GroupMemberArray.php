<?php

namespace Scouterna\Scoutorg\Lib\Arrays;

use Scouterna\Scoutorg\Lib;

class GroupMemberArray extends Lib\OrgArray
{
    /**
     * @return Lib\GroupMember 
     */
    public function get(string $source, $id): Lib\GroupMember
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Lib\GroupMember>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}