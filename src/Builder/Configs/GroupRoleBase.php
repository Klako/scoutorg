<?php

namespace Scoutorg\Builder\Configs;

use Scoutorg\Lib;

/**
 * A configuration for building a role group.
 * @property-read string $rolename
 */
class GroupRoleBase extends Lib\ReadOnlyObject
{
    public function __construct($rolename)
    {
        parent::__construct();
        $this->setProperty('rolename', ['string'], $rolename);
    }
}