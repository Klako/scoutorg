<?php

namespace Scouterna\Scoutorg\Model\Arrays;

use Scouterna\Scoutorg\Model;

class TroopRoleArray extends Model\OrgArray
{
    /** 
     * @return Model\TroopRole
     */
    public function get(string $source, $id): ?Model\TroopRole
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Model\TroopRole>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
