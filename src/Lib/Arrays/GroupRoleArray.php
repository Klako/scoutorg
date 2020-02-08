<?php

namespace Scouterna\Scoutorg\Lib\Arrays;

use Scouterna\Scoutorg\Lib;

class GroupRoleArray extends Lib\OrgArray
{
    /** 
     * @return Lib\GroupRole
     */
    public function get(string $source, $id): Lib\GroupRole
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Lib\GroupRole>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
