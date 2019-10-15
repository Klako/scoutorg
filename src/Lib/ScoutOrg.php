<?php

/**
 * Contains ScoutOrg class
 * @author Alexander Krantz
 */

namespace Scoutorg\Lib;

/**
 * Is used for getting structured information about scout groups.
 */
class ScoutOrg
{
    /** @var IScoutGroupProvider The object that provides a scout group object. */
    private $scoutGroupProvider;

    /** @var ScoutGroup The cached scout group. */
    private $loadedScoutGroup;

    /**
     * Creates a new controller from providers.
     * @internal
     * @param IPropertyProvider $scoutGroupProvider
     */
    public function __construct(
        IPropertyProvider $scoutGroupProvider
    ) {
        $this->scoutGroupProvider = $scoutGroupProvider;
    }

    /**
     * Gets the scout group structure.
     * @return ScoutGroup|false
     */
    public function getScoutGroup()
    {
        if ($this->loadedScoutGroup !== null) {
            return $this->loadedScoutGroup;
        }

        $scoutGroup = $this->scoutGroupProvider->getScoutGroup();

        if ($scoutGroup === false) {
            return false;
        }

        $this->loadedScoutGroup = $scoutGroup;
        return $scoutGroup;
    }
}
