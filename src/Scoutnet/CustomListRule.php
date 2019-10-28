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
     * @param JsonReader $jsonReader
     */
    public function __construct($jsonReader)
    {
        $this->properties = [];
        while ($jsonReader->read()) {
            if ($jsonReader->type() == JsonReader::END_OBJECT) {
                break;
            }
            $this->properties[$jsonReader->name()] = $jsonReader->value();
        }
    }

    public function __get($name)
    {
        return isset($this->properties[$name]) ? $this->properties[$name] : null;
    }
}
