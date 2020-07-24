<?php

/**
 * Contains Branch class
 * @author Alexander Krantz
 */

namespace Scouterna\Scoutorg\Model;

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
     * @param Uid $uid
     * @param string $name
     * @param IArrayPromise $troops
     */
    public function __construct(Uid $uid, string $name, IArrayPromise $troops)
    {
        parent::__construct($uid);
        $this->setProperty('name', $name);
        $this->setArray('troops', $troops);
    }
}
