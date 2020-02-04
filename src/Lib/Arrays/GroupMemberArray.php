<?php

namespace Scoutorg\Lib\Arrays;

use Scoutorg\Lib;
use Scoutorg\Lib\OrgObject;

class GroupMemberArray extends Lib\OrgArray
{
    /**
     * @return Lib\GroupMember 
     */
    public function get(string $source, $id): \Scoutorg\Lib\OrgObject
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