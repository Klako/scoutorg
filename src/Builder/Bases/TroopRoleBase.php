<?php

namespace Scouterna\Scoutorg\Builder\Bases;

use Scouterna\Scoutorg\Model\Arrays\TroopRoleArray;

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