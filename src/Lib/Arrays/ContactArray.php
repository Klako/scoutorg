<?php

namespace Scouterna\Scoutorg\Lib\Arrays;

use Scouterna\Scoutorg\Lib;

class ContactArray extends Lib\OrgArray
{
    /** 
     * @return Lib\Contact
     */
    public function get(string $source, $id): Lib\Contact
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Lib\Contact>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
