<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Model;

class MutableOrgArray extends Model\OrgArray
{
    public function insert(Model\OrgObject $orgObject, bool $overwrite = false)
    {
        $uid = $orgObject->uid;
        if ($this->exists($orgObject->uid) && !$overwrite) {
            return false;
        }
        $this->array[$uid->serialized]['object'] = $orgObject;
        return true;
    }

    public function delete(Model\Uid $uid)
    {
        if ($this->exists($uid)) {
            unset($this->array[$uid->serialized]);
            return true;
        }
        return false;
    }
}
