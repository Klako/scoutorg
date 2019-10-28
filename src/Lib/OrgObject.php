<?php

namespace Scoutorg\Lib;

/**
 * A generic organizational object.
 * @property-read string $source
 * @property-read int|string $id
 */
class OrgObject extends ReadOnlyObject
{
    protected function __construct($source, $id)
    {
        parent::__construct();
        $this->setProperty('source', ['string'], $source);
        $this->setProperty('id', ['integer', 'string'], $id);
    }
}
