<?php

namespace Scouterna\Scoutorg\Model\Arrays;

use Scouterna\Scoutorg\Model;

class PatrolRoleArray extends Model\OrgArray
{
    /** 
     * @return Model\PatrolRole
     */
    public function get(Model\Uid $uid): ?Model\PatrolRole
    {
        return parent::get($uid);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Model\PatrolRole>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
