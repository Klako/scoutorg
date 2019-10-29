<?php

namespace Scoutorg\Builder\Configs;

use Scoutorg\Lib;

/**
 * A configuration for building a custom list.
 * @property-read string $title
 * @property-read string $description
 */
class CustomListBase extends Lib\ReadOnlyObject
{
    public function __construct($title, $description)
    {
        parent::__construct();
        $this->setProperty('title', ['string'], $title);
        $this->setProperty('description', ['string'], $description);
    }
}