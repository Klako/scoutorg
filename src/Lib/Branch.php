<?php

/**
 * Contains Branch class
 * @author Alexander Krantz
 */

namespace Scoutorg\Lib;

/**
 * A branch (gren) that contains troops.
 * @property-read string $name
 * @property-read TroopArray<int,Troop> $troops
 */
class Branch extends OrgObject
{
    /**
     * Creates a new branch with an id and name.
     * @internal
     * @param string $source
     * @param int|string $id
     * @param string $name
     * @param OrgArray $troops
     */
    public function __construct($source, $id, $name, $troops)
    {
        parent::construct($source, $id);
        $this->setProperty('name', ['string'], $name);
        $this->setProperty('troops', [OrgArray::class], $troops);
    }
}
