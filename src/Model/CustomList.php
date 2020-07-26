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
 * @property-read Arrays\MemberArray<string,Member> $members
 * @property-read Arrays\CustomListArray<string,CustomList> $subLists
 */
class CustomList extends OrgObject
{
    /**
     * Creates a new custom list.
     * @internal
     */
    public function __construct(
        Uid $uid,
        string $title,
        string $description,
        IArrayPromise $members,
        IArrayPromise $subLists
    ) {
        parent::__construct($uid);
        $this->setProperty('title', $title);
        $this->setProperty('description', $description);
        $this->setArray('members', $members);
        $this->setArray('subLists', $subLists);
    }
}
