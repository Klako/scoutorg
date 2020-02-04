<?php

namespace Scoutorg\Builder\Bases;

use Scoutorg\Lib;
use Scoutorg\Lib\Arrays\PatrolArray;

/**
 * A configuration for building a patrol.
 */
class PatrolBase extends ObjectBase
{
    public const ARRAY_TYPE = PatrolArray::class;

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