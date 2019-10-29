<?php

namespace Scoutorg\Builder\Configs;

use Scoutorg\Lib;

/**
 * A unique identifier for a scoutorg object.
 * @property-read string $source
 * @property-read int|string $id
 */
class Uid extends Lib\ReadOnlyObject
{
    public function __construct($source, $id) 
    {
        parent::__construct();
        $this->setProperty('source', ['string'], $source);
        $this->setProperty('id', ['integer', 'string'], $id);
    }
}