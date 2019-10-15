<?php

namespace Scoutorg\Lib;

interface IListMutator
{
    public function canInsert($elementId = null);
    public function canDelete($elementId = null);
    public function insert($element);
    public function delete($elementId);
}
