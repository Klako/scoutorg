<?php

namespace Scouterna\Scoutorg\Model\Arrays;

use Scouterna\Scoutorg\Model;

class ContactArray extends Model\OrgArray
{
    /** 
     * @return Model\Contact
     */
    public function get(Model\Uid $uid): ?Model\Contact
    {
        return parent::get($uid);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Model\Contact>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
