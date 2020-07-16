<?php

namespace Scouterna\Scoutorg\Model\Arrays;

use Scouterna\Scoutorg\Model;

class TroopMemberArray extends Model\OrgArray
{
    /** 
     * @return Model\TroopMember
     */
    public function get(string $source, $id): ?Model\TroopMember
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Model\TroopMember>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
