<?php

namespace Scoutorg\Lib;

interface IObjectMutator
{
    public function update($property, $value);
    public function getFields();
}
