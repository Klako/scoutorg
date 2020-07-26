<?php

namespace Scouterna\Scoutorg\Builder\Bases;
/**
 * A configuration for building a patrol.
 */
class PatrolBase extends ObjectBase
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