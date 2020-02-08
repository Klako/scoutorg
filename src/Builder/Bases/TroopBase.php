<?php

namespace Scouterna\Scoutorg\Builder\Bases;

use Scouterna\Scoutorg\Lib\Arrays\TroopArray;

/**
 * A configuration for building a troop
 */
class TroopBase extends ObjectBase
{
    public const ARRAY_TYPE = TroopArray::class;
    
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
