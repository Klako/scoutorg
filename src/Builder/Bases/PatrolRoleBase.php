<?php

namespace Scouterna\Scoutorg\Builder\Bases;

use Scouterna\Scoutorg\Lib\Arrays\PatrolRoleArray;

/**
 * A configuration for building a troop
 */
class PatrolRoleBase extends ObjectBase
{
    public const ARRAY_TYPE = PatrolRoleArray::class;

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
