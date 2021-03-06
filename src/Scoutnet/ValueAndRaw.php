<?php
/**
 * Contains ValueAndRaw class
 * @author Alexander Krantz
 */
namespace Scouterna\Scoutorg\Scoutnet;

/**
 * Equivalent to a scoutnet api data field
 * with both value and raw value.
 */
class ValueAndRaw {
    /** @var string The raw value*/
    public $rawValue;

    /** @var string The normal value*/
    public $value;
    
    /**
     * Creates a new value with raw value from a scoutnet value.
     * @param object $value
     */
    public function __construct($object) {
        $this->value = $object->value;
        $this->rawValue = $object->raw_value;
    }

    /**
     * Gets the string equivalent of the class.
     * @return string
     */
    public function __toString() {
        return $this->value;
    }
}