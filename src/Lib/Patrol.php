<?php

/**
 * Contains Patrol class
 * @author Alexander Krantz
 */

namespace Scoutorg\Lib;

/**
 * A scout patrol that is in a troop.
 * @property-read string $name
 * @property-read Troop $troop
 * @property-read OrgArray<int,Member> $members
 */
class Patrol extends OrgObject
{
    /**
     * Creates a new patrol.
     * @internal
     * @param int $id
     * @param string $name
     * @param Troop|IPropertyProvider $troop
     * @param OrgArray<int,Member>|IPropertyProvider $members
     */
    public function __construct(IObjectMutator $mutator, $id, $name, $troop, $members)
    {
        parent::__construct($mutator, $id);
        $this->setProperty('name', ['string'], $name, false);
        $this->setProperty('troop', [Troop::class], $troop);
        $this->setProperty('members', [OrgArray::class], $members);
    }
}
