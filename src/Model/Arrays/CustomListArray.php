<?php

namespace Scouterna\Scoutorg\Model\Arrays;

use Scouterna\Scoutorg\Model;

class CustomListArray extends Model\OrgArray
{
    /** 
     * @return Model\CustomList
     */
    public function get(string $source, $id): ?Model\CustomList
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Model\CustomList>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
