<?php

/**
 * Contains GroupRole class
 * @author Alexander Krantz
 */

namespace Scouterna\Scoutorg\Lib;

/**
 * A group for a special role in the scout group
 * @property-read string $name
 */
class GroupRole extends OrgObject
{
    /**
     * Creates a new group role with the specified role.
     * @internal
     * @param string $source
     * @param int|string $id
     * @param string $name
     */
    public function __construct(string $source, $id, string $name)
    {
        parent::__construct($source, $id);
        $this->setProperty('name', $name);
    }
}
