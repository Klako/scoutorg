<?php

namespace Scouterna\Scoutorg\Model\Arrays;

use Scouterna\Scoutorg\Model;

class BranchArray extends Model\OrgArray
{
    /** 
     * @return Model\Branch
     */
    public function get(string $source, $id): ?Model\Branch
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Model\Branch>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
