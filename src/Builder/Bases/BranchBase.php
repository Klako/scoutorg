<?php

namespace Scouterna\Scoutorg\Builder\Bases;

use Scouterna\Scoutorg\Model\Arrays\BranchArray;

/**
 * A configuration for building a branch.
 */
class BranchBase extends ObjectBase
{
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
