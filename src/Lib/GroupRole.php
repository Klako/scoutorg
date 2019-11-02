<?php

/**
 * Contains GroupRole class
 * @author Alexander Krantz
 */

namespace Scoutorg\Lib;

/**
 * A group for a special role in the scout group
 * @property-read string $roleName
 * @property-read Dummies\MemberArray<int,Member> $members
 */
class GroupRole extends OrgObject
{
    /**
     * Creates a new group role with the specified role.
     * @internal
     * @param string $source
     * @param int|string $id
     * @param string $roleName
     * @param OrgArray<int,Member> $members
     */
    public function __construct($source, $id, $roleName, $members)
    {
        parent::__construct($source, $id);
        $this->setProperty('roleName', ['string'], $roleName);
        $this->setProperty('members', [OrgArray::class], $members);
    }
}
