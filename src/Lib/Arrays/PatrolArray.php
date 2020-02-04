<?php

namespace Scoutorg\Lib\Arrays;

use Scoutorg\Lib;

class PatrolArray extends Lib\OrgArray
{
    /** 
     * @return Lib\Patrol
     */
    public function get(string $source, $id): Lib\Patrol
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Lib\Patrol>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
