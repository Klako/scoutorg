<?php

namespace Scouterna\Scoutorg\Builder\Bases;

use Scouterna\Scoutorg\Lib\Arrays\BranchArray;

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
