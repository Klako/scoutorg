<?php

namespace Scoutorg\Scoutnet\Handlers;

use Scoutorg\Scoutnet\PartFactory;

abstract class Handler
{
    /** @var PartFactory */
    protected $factory;

    public function __construct($factory)
    {
        $this->factory = $factory;
    }

    public abstract function getBasePart($id);
    public abstract function getLinkPart($id, $method);
    public abstract function getLinkParts($id, $method);
}
