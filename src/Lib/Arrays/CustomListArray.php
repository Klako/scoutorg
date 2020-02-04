<?php

namespace Scoutorg\Lib\Arrays;

use Scoutorg\Lib;

class CustomListArray extends Lib\OrgArray
{
    /** 
     * @return Lib\CustomList
     */
    public function get(string $source, $id): Lib\CustomList
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Lib\CustomList>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
