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
 * @property-read Dummys\MemberArray<int,Member> $members
 * @property-read Dummys\CustomListArray<int,CustomList> $subLists
 */
class CustomList extends OrgObject
{
    /**
     * Creates a new custom list.
     * @internal
     * @param string $source
     * @param int|string $id
     * @param string $title
     * @param string $description
     * @param OrgArray<int,Member> $members
     * @param OrgArray<int,CustomList> $subLists
     */
    public function __construct($source, $id, $title, $description, $members, $subLists)
    {
        parent::__construct($source, $id);
        $this->setProperty('title', ['string'], $title);
        $this->setProperty('description', ['string'], $description);
        $this->setProperty('members', [OrgArray::class], $members);
        $this->setProperty('subLists', [OrgArray::class], $subLists);
    }
}
