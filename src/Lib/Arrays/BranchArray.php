<?php

namespace Scouterna\Scoutorg\Lib\Arrays;

use Scouterna\Scoutorg\Lib;

class BranchArray extends Lib\OrgArray
{
    /** 
     * @return Lib\Branch
     */
    public function get(string $source, $id): Lib\Branch
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Lib\Branch>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
