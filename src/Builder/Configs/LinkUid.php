<?php

namespace Scoutorg\Builder\Configs;

/**
 * Represents a unique id of an object that acts
 * as a link/edge to another object.
 * @property-read string $targetSource
 * @property-read int|string $targetId
 */
class LinkUid extends Uid
{
    public function __construct($source, $id, $targetSource, $targetId)
    {
        parent::__construct($source, $id);
        $this->setProperty('targetSource', ['string'], $targetSource);
        $this->setProperty('targetId', ['integer', 'string'], $targetId);
    }
}
