<?php

namespace Scoutorg\Lib;

class Property
{
    public $types;

    public $value;

    public function __construct($types, $value)
    {
        $this->types = $types;
        $this->value = $value;
    }
}
