<?php

namespace Scoutorg\Lib\Arrays;

use Scoutorg\Lib;

class ScoutGroupArray extends Lib\OrgArray
{
    /** 
     * @return Lib\ScoutGroup
     */
    public function get(string $source, $id): Lib\ScoutGroup
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Lib\ScoutGroup>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
