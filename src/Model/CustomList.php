<?php

/**
 * Contains CustomList class
 * @author Alexander Krantz
 */

namespace Scouterna\Scoutorg\Model;

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
     * @param Uid $uid
     * @param string $title
     * @param string $description
     * @param Arrays\MemberArray|IArrayPromise $members
     * @param Arrays\CustomListArray|IArrayPromise $subLists
     */
    public function __construct(Uid $uid, string $title, string $description, $members, $subLists)
    {
        parent::__construct($uid);
        $this->setProperty('title', $title);
        $this->setProperty('description', $description);
        $this->setArray('members', $members, Arrays\MemberArray::class);
        $this->setArray('subLists', $subLists, Arrays\CustomListArray::class);
    }
}
