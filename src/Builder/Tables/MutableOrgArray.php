<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Lib;

class MutableOrgArray extends Lib\OrgArray
{
    public function insert(Lib\OrgObject $orgObject, bool $overwrite = false)
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
