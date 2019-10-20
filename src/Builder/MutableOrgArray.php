<?php

namespace Scoutorg\Builder;

use Scoutorg\Lib;

class MutableOrgArray extends Lib\OrgArray
{
    public function canInsert($orgObject)
    {
        if ($this->exists($orgObject->source, $orgObject->id)) {
            return false;
        }
        return true;
    }

    public function insert($orgObject)
    {
        if ($this->exists($orgObject->source, $orgObject->id)){
            return false;
        }
        $this->tree[$orgObject->source][$orgObject->id] = $orgObject;
        return true;
    }

    public function canDelete($source, $index)
    {
        if ($this->exists($source, $index)) {
            return true;
        }
        return false;
    }

    public function delete($source, $index)
    {
        if (!$this->exists($source, $index)) {
            unset($this->tree[$source][$index]);
            return true;
        }
        return false;
    }
}