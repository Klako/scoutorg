<?php

/**
 * Contains GroupRole class
 * @author Alexander Krantz
 */

namespace Scouterna\Scoutorg\Model;

/**
 * A group for a special role in the scout group
 * @property-read string $name
 */
class GroupRole extends OrgObject
{
    /**
     * Creates a new group role with the specified role.
     * @internal
     */
    public function __construct(Uid $uid, string $name)
    {
        parent::__construct($uid);
        $this->setProperty('name', $name);
    }
}
