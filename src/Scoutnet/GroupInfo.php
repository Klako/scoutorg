<?php

namespace Scoutorg\Scoutnet;

use pcrov\JsonReader\JsonReader;

/**
 * A group info object.
 * @property-read string $name
 * @property-read int $membercount
 * @property-read int $rolecount
 * @property-read int $waitingcount
 * @property-read bool $group_email
 * @property-read string $email
 * @property-read string $description
 * @property-read int $below_26
 * @property-read int $active_troops
 */
class GroupInfo
{
    private $properties;

    /**
     * Creates a member object from a json reader
     * @param JsonReader $jsonReader
     */
    public function __construct($jsonReader)
    {
        $this->properties = [];
        $jsonReader->read('Group');
        $jsonReader->read();
        do {
            if ($jsonReader->type() == JsonReader::END_OBJECT) {
                break;
            }
            switch ($jsonReader->name()) {
                case 'name':
                case 'membercount':
                case 'rolecount':
                case 'waitingcount':
                case 'group_email':
                case 'email':
                case 'description':
                case 'below_26':
                case 'active_troops':
                    $this->properties[$jsonReader->name()] = $jsonReader->value();
                    break;
                default:
                    break;
            }
        } while ($jsonReader->next());
    }

    public function __get($name)
    {
        return isset($this->properties[$name]) ? $this->properties[$name] : null;
    }
}
