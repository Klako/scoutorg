<?php

namespace Scouterna\Scoutorg\Builder\Bases;

/**
 * A configuration for building a group role.
 */
class GroupRoleBase extends ObjectBase
{
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