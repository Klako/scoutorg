<?php

namespace Scoutorg\Builder\Bases;

use Scoutorg\Builder\Uid;
use Scoutorg\Lib\Arrays\BranchArray;

/**
 * A configuration for building a branch.
 */
class BranchBase extends ObjectBase
{
    public const ARRAY_TYPE = BranchArray::class;

    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
}
