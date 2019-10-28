<?php

/**
 * Contains CustomListMemberEntry class
 * @author Alexander Krantz
 */

namespace Scoutorg\Scoutnet;

use pcrov\JsonReader\JsonReader;

/**
 * Contains fields from that are equivalent to custom list members from scoutnet.
 * @property-read Value $email The member's email.
 * @property-read Value $extra_emails The member's other emails.
 * @property-read Value $member_no The member's scoutnet id.
 * @property-read Value $first_name The member's first name.
 * @property-read Value $last_name The member's last name.
 */
class CustomListMember
{
    private $properties;

    /**
     * Creates a member object from a json reader
     * @param JsonReader $jsonReader
     */
    public function __construct($jsonReader)
    {
        $this->properties = [];
        while ($jsonReader->read()) {
            $this->createValue($jsonReader->name(), $jsonReader);
        }
    }

    private function createValue($name, $jsonReader)
    {
        $object = $jsonReader->value();
        if (isset($object->raw_value)) {
            $this->properties[$name] = new ValueAndRaw($object);
        } else {
            $this->properties[$name] = new Value($object);
        }
    }

    public function __get($name)
    {
        return isset($this->properties[$name]) ? $this->properties[$name] : null;
    }
}
