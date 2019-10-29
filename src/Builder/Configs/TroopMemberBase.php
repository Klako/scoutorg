<?php

namespace Scoutorg\Builder\Configs;

use Scoutorg\Lib;

/**
 * A configuration for building a troop member.
 * @property-read string $role
 */
class TroopMemberBase extends Lib\ReadOnlyObject
{
    public function __construct($role)
    {
        parent::__construct();
        $this->setProperty('role', ['string'], $role);
    }
}