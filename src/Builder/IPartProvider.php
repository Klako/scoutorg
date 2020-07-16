<?php

namespace Scouterna\Scoutorg\Builder;

use Scouterna\Scoutorg\Model\Uid;

interface IPartProvider
{
    /**
     * Gets the base part of an object with the given id and base type.
     * The data source of the object is already known.
     * @param int|string $id 
     * @param string $type 
     * @return Bases\ObjectBase|null
     */
    public function getBasePart($id, string $type): ?Bases\ObjectBase;

    /**
     * Gets all links, from an object with the given unique id
     * and base type, to objects with the given name.
     * @param Uid $uid 
     * @param string $type
     * @param string $name 
     * @return Uid[]|EdgeUid[]
     */
    public function getLinkParts(
        Uid $uid,
        string $type,
        string $name
    ): array;

    /**
     * Gets on link, from an object with the given unique id
     * and base type, to an object with the given name.
     * @param Uid $uid 
     * @param string $type
     * @param string $name 
     * @return Uid|EdgeUid|null
     */
    public function getLinkPart(
        Uid $uid,
        string $type,
        string $name
    ): ?Uid;
}
