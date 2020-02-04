<?php

namespace Scoutorg\Builder\Bases;

use Scoutorg\Lib\Arrays\GroupRoleArray;

/**
 * A configuration for building a group role.
 */
class GroupRoleBase extends ObjectBase
{
    public const ARRAY_TYPE = GroupRoleArray::class;

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