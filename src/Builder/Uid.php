<?php

namespace Scouterna\Scoutorg\Builder;

/**
 * A unique identifier for a Scouterna\Scoutorg object.
 */
class Uid
{
    private $source;
    private $id;

    public function __construct(string $source, $id)
    {
        $this->source = $source;
        Helpers::checkType('id', $id, ['integer', 'string']);
        $this->id = $id;
    }

    /**
     * Get the value of source
     */ 
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }
}
