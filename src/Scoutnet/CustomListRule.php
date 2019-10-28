<?php

/**
 * Contains CustomListRule class
 * @author Alexander Krantz
 */

namespace Scoutorg\Scoutnet;

use pcrov\JsonReader\JsonReader;

/**
 * Contains fields that are equivalent to custom list rules from scoutnet.
 * @property-read int $id
 * @property-read string $title
 * @property-read string $link
 */
class CustomListRule
{
    const NO_RULE_ID = -1;

    private $properties;

    /**
     * Creates a new custom list rule entry from a scoutnet entry.
     * @param object $object
     */
    public function __construct($object)
    {
        $this->properties = [];
        $this->properties['id'] = $object->id;
        $this->properties['title'] = $object->title;
        $this->properties['link'] = $object->link;
    }

    public function __get($name)
    {
        return isset($this->properties[$name]) ? $this->properties[$name] : null;
    }
}
