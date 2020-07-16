<?php

namespace Scouterna\Scoutorg\Model;

/**
 * A unique identifier for a Scouterna\Scoutorg object.
 */
class Uid
{
    private $source;
    private $id;

    public function __construct(string $source, $id)
    {
        $this->source = $source;
        Helper::checkType('id', $id, ['integer', 'string']);
        $this->id = $id;
    }

    /**
     * Get the value of source
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Deserializes a string into a uid.
     * @param string $uid 
     * @return Uid 
     */
    public static function deserialize(string $uid)
    {
        $splitId = \explode(':', $uid, 2);
        if ($splitId === false) {
            return false;
        }
        return new Uid($splitId[0], $splitId[1]);
    }

    /**
     * Serializes the uid into a string that
     * can then be deserialized with deserialize()
     * @return string 
     */
    public function serialize()
    {
        return "{$this->source}:{$this->id}";
    }
}
