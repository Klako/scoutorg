<?php

namespace Scouterna\Scoutorg\Lib;

/**
 * A type of role.
 * @property-read string $name
 */
class PatrolRole extends OrgObject
{
    /**
     * Creates a new patrol role.
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
