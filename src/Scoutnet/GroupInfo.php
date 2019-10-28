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
 */
class GroupInfo
{
    private $properties;

    /**
     * Creates a member object from a json reader
     * @param object $object
     */
    public function __construct($object)
    {
        $this->properties = [];
        $group = $object->Group;
        $this->properties['name'] = $group->name;
        $this->properties['membercount'] = $group->membercount;
        $this->properties['rolecount'] = $group->rolecount;
        $this->properties['waitingcount'] = $group->waitingcount;
        $this->properties['group_email'] = $group->group_email;
        $this->properties['email'] = $group->email;
        $this->properties['description'] = $group->description;
    }

    public function __get($name)
    {
        return isset($this->properties[$name]) ? $this->properties[$name] : null;
    }
}
