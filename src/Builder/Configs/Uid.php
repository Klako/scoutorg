<?php

namespace Scoutorg\Builder\Configs;

/**
 * A unique identifier for a scoutorg object.
 * @property-read string $source
 * @property-read int|string $id
 */
class Uid
{
    public $source;
    public $id;

    public function __construct($source, $id) 
    {
        $this->source = $source;
        $this->id = $id;
    }
}