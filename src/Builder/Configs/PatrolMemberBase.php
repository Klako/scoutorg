<?php

namespace Scoutorg\Builder\Configs;

use Scoutorg\Lib;

/**
 * A configuration for building a patrol member
 * @property-read string $role
 */
class PatrolMemberBase extends Lib\ReadOnlyObject
{
    public function __construct($role)
    {
        parent::__construct();
        $this->setProperty('role', ['string'], $role);
    }
}