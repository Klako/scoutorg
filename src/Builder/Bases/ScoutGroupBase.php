<?php

namespace Scouterna\Scoutorg\Builder\Bases;

use Scouterna\Scoutorg\Model\Arrays\ScoutGroupArray;

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