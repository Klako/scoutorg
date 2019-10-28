<?php

/**
 * Contains ScoutGroupConfig class
 * @author Alexander Krantz
 */

namespace Scoutorg\Scoutnet;

/**
 * Class that contains settings for a scout group.
 */
class ScoutGroupConfig
{
    /** @var int Group scoutnet id. */
    private $groupId;

    /** @var string Group info api key. */
    private $groupInfoKey;

    /** @var string Member list api key. */
    private $memberListKey;

    /** @var string Custom lists api key. */
    private $customListsKey;

    /**
     * Creates a new configuration.
     * @param int $groupId
     * @param string $memberListApiKey
     * @param string $customListsApiKey
     */
    public function __construct(
        int $groupId,
        string $groupInfoApiKey,
        string $memberListApiKey,
        string $customListsApiKey
    ) {
        $this->groupId = $groupId;
        $this->groupInfoKey = $groupInfoApiKey;
        $this->memberListKey = $memberListApiKey;
        $this->customListsKey = $customListsApiKey;
    }

    /**
     * Gets the group scoutnet id.
     * @return string
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * Gets the group info api key.
     * @return string
     */
    public function getGroupInfoKey()
    {
        return $this->groupInfoKey;
    }

    /**
     * Gets the member list api key.
     * @return string
     */
    public function getMemberListKey()
    {
        return $this->memberListKey;
    }

    /**
     * Gets the custom lists api key.
     * @return string
     */
    public function getCustomListsKey()
    {
        return $this->customListsKey;
    }
}
