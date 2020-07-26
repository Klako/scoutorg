<?php

namespace Scouterna\Scoutorg\Model;

/**
 * A type of role.
 * @property-read string $name
 */
class TroopRole extends OrgObject
{
    /**
     * Creates a new troop role.
     * @internal
     */
    public function __construct(Uid $uid, string $name)
    {
        parent::__construct($uid);
        $this->setProperty('name', $name);
    }
}
