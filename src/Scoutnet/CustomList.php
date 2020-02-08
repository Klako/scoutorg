<?php

/**
 * Contains CustomListEntry class
 * @author Alexander Krantz
 */

namespace Scouterna\Scoutorg\Scoutnet;

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
     * @param object $object
     */
    public function __construct($object)
    {
        $this->properties = [];
        $this->properties['id'] = $object->id;
        $this->properties['title'] = $object->title;
        $this->properties['description'] = $object->description;
        $this->properties['list_email_key'] = $object->list_email_key;
        $this->properties['aliases'] = $object->aliases;
        $this->properties['rules'] = [];
        foreach ($object->rules as $id => $rule) {
            $this->properties['rules'][$id] = new CustomListRule($rule);
        }
    }

    public function __get($name)
    {
        return isset($this->properties[$name]) ? $this->properties[$name] : null;
    }

    public function __isset($name){
        return isset($this->properties[$name]);
    }
}
