<?php

namespace Scoutorg\Lib\Arrays;

use Scoutorg\Lib;

class PatrolRoleArray extends Lib\OrgArray
{
    /** 
     * @return Lib\PatrolRole
     */
    public function get(string $source, $id): Lib\PatrolRole
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source
     * @return \Generator<int|string,Lib\PatrolRole>
     */
    public function fromSource(string $source): \Generator
    {
        return parent::fromSource($source);
    }
}
