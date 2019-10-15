<?php

/**
 * Contains RoleGroup class
 * @author Alexander Krantz
 */

namespace Scoutorg\Lib;

/**
 * A group for a special role in the scout group
 * @property-read string $roleName
 * @property-read OrgArray<int,Member> $members
 */
class RoleGroup extends OrgObject
{
    /**
     * Creates a new RoleGroup with the specified role.
     * @internal
     * @param IObjectMutator $mutator
     * @param int $id
     * @param string $roleName
     * @param OrgArray<int,Member>|IPropertyProvider $members
     */
    public function __construct(IObjectMutator $mutator, $id, $roleName, $members)
    {
        parent::__construct($mutator, $id);
        $this->setProperty('roleName', ['string'], $roleName, false);
        $this->setProperty('members', [OrgArray::class], $members);
    }
}
