<?php

namespace Scouterna\Scoutorg\Scoutnet\Handlers;

use Scouterna\Scoutorg\Scoutnet\PartFactory;

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
