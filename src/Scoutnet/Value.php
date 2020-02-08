<?php
/**
 * Contains Value class
 * @author Alexander Krantz
 */
namespace Scouterna\Scoutorg\Scoutnet;

/**
 * Equivalent to a scoutnet api field with only a value.
 */
class Value {
    /** @var string The value */
    public $value;

    /**
     * Creates a new value from a scoutnet value.
     * @param object $object
     */
    public function __construct($object) {
        $this->value = $object->value;
    }

    /**
     * Gets the string equivalent of the class.
     * @return string
     */
    public function __toString() {
        return $this->value;
    }
}