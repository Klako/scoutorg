<?php

namespace Scoutorg\Builder\Bases;

use Scoutorg\Builder\Uid;
use Scoutorg\Lib;
use Scoutorg\Lib\Arrays\CustomListArray;

/**
 * A configuration for building a custom list.
 */
class CustomListBase extends ObjectBase
{
    public const ARRAY_TYPE = CustomListArray::class;

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
