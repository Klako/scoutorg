<?php

namespace Scouterna\Scoutorg\Model\Arrays;

use Scouterna\Scoutorg\Model;

class PatrolRoleArray extends Model\OrgArray
{
    /** 
     * @return Model\PatrolRole
     */
    public function get(string $source, $id): ?Model\PatrolRole
    {
        return parent::get($source, $id);
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
