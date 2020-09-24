<?php

namespace Scouterna\Scoutorg\Model;

/**
 * A unique identifier for a Scouterna\Scoutorg object.
 * @property-read string $source
 * @property-read int|string $id
 * @property-read string $serialized
 */
class Uid extends ReadOnlyObject
{
    public function __construct(string $source, $id)
    {
        parent::__construct();
        $this->setProperty('source', $source);
        $this->setProperty('id', $id, ['integer', 'string']);
        $this->setProperty('serialized', $this->serialize());
    }

    /**
     * Get the value of source
     */
    public function getSource()
    {
        return $this->getProperty('source');
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->getProperty('id');
    }

    /**
     * Deserializes a string into a uid.
     * @param string $uid 
     * @return Uid|null
     */
    public static function deserialize(string $uid)
    {
        $splitId = \explode(':', $uid, 2);
        if ($splitId === false || count($splitId) != 2) {
            return null;
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
        return "{$this->getProperty('source')}:{$this->getProperty('id')}";
    }
}
