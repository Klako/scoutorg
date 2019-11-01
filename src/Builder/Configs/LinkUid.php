<?php

namespace Scoutorg\Builder\Configs;

/**
 * Represents a unique id of an object that acts
 * as a link/edge to another object.
 * @property-read Uid $target
 */
class LinkUid extends Uid
{
    public $target;

    public function __construct($source, $id, $target)
    {
        parent::__construct($source, $id);
        $this->target = $target;
    }
}
