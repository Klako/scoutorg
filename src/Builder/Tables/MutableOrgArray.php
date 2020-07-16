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
        [$source, $id] = [$uid->getSource(), $uid->getId()];
        $this->tree[$source][$id] = $orgObject;
        return true;
    }

    public function delete(Model\Uid $uid)
    {
        [$source, $id] = [$uid->getSource(), $uid->getId()];
        if ($this->exists($source, $id)) {
            unset($this->tree[$source][$id]);
            return true;
        }
        return false;
    }
}
