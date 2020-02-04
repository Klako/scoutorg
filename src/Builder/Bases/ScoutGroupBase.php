<?php

namespace Scoutorg\Builder\Bases;

use Scoutorg\Lib;
use Scoutorg\Lib\Arrays\ScoutGroupArray;

/**
 * A configuration for building a scout group.
 */
class ScoutGroupBase extends ObjectBase
{
    public const ARRAY_TYPE = ScoutGroupArray::class;

    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }
}