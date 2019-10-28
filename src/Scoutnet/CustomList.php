<?php

/**
 * Contains CustomListEntry class
 * @author Alexander Krantz
 */

namespace Scoutorg\Scoutnet;

use pcrov\JsonReader\JsonReader;

/**
 * Contains fields that are equivalent to custom lists from scoutnet.
 * @property-read int $id
 * @property-read string $title
 * @property-read string $description
 * @property-read string $list_email_key
 * @property-read string[] $aliases
 * @property-read CustomListRule[] $rules
 */
class CustomList
{
    private $properties;

    /**
     * Creates a new custom list rule entry from a scoutnet entry.
     * @param JsonReader $jsonReader
     */
    public function __construct($jsonReader)
    {
        $this->properties = [];
        while ($jsonReader->read()) {
            if ($jsonReader->name() == 'rules') {
                $jsonReader->read();
                $this->properties['rules'] = [];
                while ($jsonReader->read()) {
                    if ($jsonReader->type() == JsonReader::END_OBJECT) {
                        break;
                    }
                    $this->properties['rules'][$jsonReader->name()] = new CustomListRule($jsonReader);
                }
            } else {
                $this->properties[$jsonReader->name()] = $jsonReader->value();
            }
        }
    }

    public function __get($name)
    {
        return isset($this->properties[$name]) ? $this->properties[$name] : null;
    }
}
