<?php

/**
 * Contains CustomList class
 * @author Alexander Krantz
 */

namespace Scoutorg\Lib;

/**
 * A custom member list with sub lists.
 * @property-read string $title
 * @property-read string $description
 * @property-read OrgArray<int,Member> $members
 * @property-read OrgArray<int,CustomList> $subLists
 */
class CustomList extends OrgObject
{
    /**
     * Creates a new custom list.
     * @internal
     * @param int $id
     * @param string $title
     * @param string $description
     * @param OrgArray<int,Member>|IPropertyProvider $members
     * @param OrgArray<int,CustomList>|IPropertyProvider $subLists
     */
    public function __construct(IObjectMutator $mutator, $id, $title, $description, $members, $subLists)
    {
        parent::__construct($mutator, $id);
        $this->setProperty('title', ['string'], $title, false);
        $this->setProperty('description', ['string'], $description, false);
        $this->setProperty('members', [OrgArray::class], $members);
        $this->setProperty('subLists', [OrgArray::class], $subLists);
    }
}
