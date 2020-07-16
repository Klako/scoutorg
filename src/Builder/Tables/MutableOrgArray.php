<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Model;

class MutableOrgArray extends Model\OrgArray
{
    public function insert(Model\OrgObject $orgObject, bool $overwrite = false)
    {
        if ($this->exists($orgObject->source, $orgObject->id) && !$overwrite) {
            return false;
        }
        $this->tree[$orgObject->source][$orgObject->id] = $orgObject;
        return true;
    }

    public function delete(string $source, $id)
    {
        if ($this->exists($source, $id)) {
            unset($this->tree[$source][$id]);
            return true;
        }
        return false;
    }
}
