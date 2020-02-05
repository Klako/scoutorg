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
 * @property-read Arrays\MemberArray<mixed,Member> $members
 * @property-read Arrays\CustomListArray<mixed,CustomList> $subLists
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
     * @param OrgArray<Member> $members
     * @param OrgArray<CustomList> $subLists
     */
    public function __construct(string $source, $id, string $title, string $description, $members, $subLists)
    {
        parent::__construct($source, $id);
        $this->setProperty('title', $title);
        $this->setProperty('description', $description);
        $this->setArray('members', $members, Arrays\MemberArray::class);
        $this->setArray('subLists', $subLists, Arrays\CustomListArray::class);
    }
}
