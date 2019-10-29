<?php

namespace Scoutorg\Builder\Configs;

use Scoutorg\Lib;

/**
 * A configuration for building a patrol.
 * @property-read string $name
 */
class PatrolBase extends Lib\ReadOnlyObject
{
    public function __construct($name)
    {
        parent::__construct();
        $this->setProperty('name', ['string'], $name);
    }
}