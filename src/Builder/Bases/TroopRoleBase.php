<?php

namespace Scoutorg\Builder\Bases;

use Scoutorg\Lib;
use Scoutorg\Lib\Arrays\TroopRoleArray;

/**
 * A configuration for building a troop
 */
class TroopRoleBase extends ObjectBase
{
    public const ARRAY_TYPE = TroopRoleArray::class;

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