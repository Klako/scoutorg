<?php

namespace Scouterna\Scoutorg\Builder\Bases;

/**
 * A configuration for building a custom list.
 */
class CustomListBase extends ObjectBase
{
    private $title;
    private $description;

    public function __construct(string $title, string $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
