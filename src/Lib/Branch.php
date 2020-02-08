<?php

/**
 * Contains Branch class
 * @author Alexander Krantz
 */

namespace Scouterna\Scoutorg\Lib;

/**
 * A branch (gren) that contains troops.
 * @property-read string $name
 * @property-read Arrays\TroopArray<mixed,Troop> $troops
 */
class Branch extends OrgObject
{
    /**
     * Creates a new branch with an id and name.
     * @internal
     * @param string $source
     * @param int|string $id
     * @param string $name
     * @param Arrays\TroopArray|IArrayPromise $troops
     */
    public function __construct(string $source, $id, string $name, $troops)
    {
        parent::__construct($source, $id);
        $this->setProperty('name', $name);
        $this->setArray('troops', $troops, Arrays\TroopArray::class);
    }
}
