<?php

/**
 * Contains ScoutnetController class
 * @author Alexander Krantz
 */

namespace Scoutorg\Scoutnet;

use pcrov\JsonReader\JsonReader;

/**
 * Contains methods for getting data from scoutnet.
 */
class ScoutnetController
{
    /** @var string The url variables for fetching the waiting list. */
    const API_MEMBERLIST_WAITING_URLVARS = 'waiting=1';

    /** @var int The value of the scoutnet cache when it is disabled. */
    const CACHE_DISABLE = 0;

    /** @var ScoutnetConnection The scoutnet connection. */
    private $connection;

    /** @var int The ttl of the long lived cache in seconds. zero = disabled. */
    private $cacheTtl;

    /**
     * Creates a new scoutnet group link.
     * @param ScoutnetConnection $connection
     */
    public function __construct(ScoutnetConnection $connection, int $cacheTtl = self::CACHE_DISABLE)
    {
        $this->connection = $connection;
        $this->cacheTtl = $cacheTtl;
    }

    /**
     * Gets the group scoutnet id.
     * @return int
     */
    public function getGroupId()
    {
        return $this->connection->getGroupConfig()->getGroupId();
    }

    public function getGroupInfo()
    {
        if ($this->cacheTtl !== self::CACHE_DISABLE) {
            $cache = $this->getCacheResource('groupinfo');
            if ($cache) {
                return $cache;
            }
        }

        $jsonReader = $this->connection->fetchGroupInfoApi();
        $groupInfo = new GroupInfo($jsonReader);

        if ($this->cacheTtl !== self::CACHE_DISABLE) {
            $this->setCacheResource('groupinfo', $groupInfo);
        }

        return $groupInfo;
    }

    /**
     * Gets the group member list.
     * @return Member[]
     */
    public function getMemberList()
    {
        if ($this->cacheTtl !== self::CACHE_DISABLE) {
            $cache = $this->getCacheResource('members');
            if ($cache) {
                return $cache;
            }
        }

        $t = \microtime(true);
        
        $jsonReader = $this->connection->fetchMemberListApi('');

        echo "Fetched member list in ". (\microtime(true) - $t) . " seconds\n";

        $t = \microtime(true);

        $jsonReader->read('data');
        $jsonReader->read();

        $members = [];
        while ($jsonReader->type() !== JsonReader::END_OBJECT) {
            $id = intval($jsonReader->name());
            $jsonReader->read();
            $members[$id] = new Member($jsonReader);
            $jsonReader->read();
        } 

        $jsonReader->close();

        echo "Read memberlist data in ". (\microtime(true) - $t) . " seconds\n";

        if ($this->cacheTtl !== self::CACHE_DISABLE) {
            $this->setCacheResource('members', $members);
        }

        return $members;
    }

    /**
     * Gets the group waiting list.
     * @return WaitingMember[]|false
     */
    public function getWaitingList()
    {
        if ($this->cacheTtl !== self::CACHE_DISABLE) {
            $cache = $this->getCacheResource('waitinglist');
            if ($cache) {
                return $cache;
            }
        }

        $jsonReader = $this->connection->fetchMemberListApi('waiting=1');

        if ($jsonReader->name() !== 'data') {
            $jsonReader->read('data');
        }

        $waitingMembers = [];
        while ($jsonReader->read()) {
            if ($jsonReader->type() == JsonReader::END_OBJECT) {
                break;
            }
            $waitingMembers[$jsonReader->name()] = new WaitingMember($jsonReader);
        }
        $jsonReader->close();

        if ($this->cacheTtl !== self::CACHE_DISABLE) {
            $this->setCacheResource('waitinglist', $waitingMembers);
        }

        return $waitingMembers;
    }

    /**
     * Gets all custom mailing lists from scoutnet.
     * @return CustomList[]
     */
    public function getCustomLists()
    {
        if ($this->cacheTtl !== self::CACHE_DISABLE) {
            $cache = $this->getCacheResource('customlists');
            if ($cache) {
                return $cache;
            }
        }

        $jsonReader = $this->connection->fetchCustomListsApi('');

        $customLists = [];
        while ($jsonReader->read()) {
            if ($jsonReader->type() == JsonReader::NONE) {
                break;
            }
            $customLists[$jsonReader->name()] = new CustomList($jsonReader);
        }
        $jsonReader->close();

        if ($this->cacheTtl !== self::CACHE_DISABLE) {
            $this->setCacheResource('customlists', $customLists);
        }

        return $customLists;
    }

    /**
     * Gets all members in a custom mailinng list or one of its rules.
     * @param int $listId The custom mailing list id.
     * @param int $ruleId The rule id.
     * Leave to default (CustomListRuleEntry::NO_RULE_ID) if the whole mailing list is wanted.
     * @return CustomListMember[]
     */
    public function getCustomListMembers(int $listId, int $ruleId = CustomListRuleEntry::NO_RULE_ID)
    {
        if ($this->cacheTtl !== self::CACHE_DISABLE) {
            $cache = $this->getCacheResource("customlistmembers:$listId:$ruleId");
            if ($cache) {
                return $cache;
            }
        }

        $urlVars = $this->buildCustomListVars($listId, $ruleId);
        $jsonReader = $this->connection->fetchCustomListsApi($urlVars);

        $customListMembers = [];
        while ($jsonReader->read()) {
            if ($jsonReader->type() == JsonReader::NONE) {
                break;
            }
            $customListMembers[$jsonReader->name()] = new CustomListMember($jsonReader);
        }
        $jsonReader->close();

        if ($this->cacheTtl !== self::CACHE_DISABLE) {
            $this->setCacheResource("customlistmembers:$listId:$ruleId", $customListMembers);
        }

        return $customListMembers;
    }

    /**
     * Builds a string from the list id and rule id for
     * using when fetching a custom member list with the
     * custom list api.
     * @param int $listId
     * @param int $ruleId
     * @return string
     */
    private function buildCustomListVars(int $listId, int $ruleId)
    {
        $retVal = "list_id=$listId";
        if ($ruleId !== CustomListRule::NO_RULE_ID) {
            $retVal = $retVal . "&rule_id=$ruleId";
        }
        return $retVal;
    }

    /**
     * Gets a cache resource from the APCu.
     * @param string $uri The resource uri (name of the resource in scoutnet).
     * @return mixed
     */
    private function getCacheResource(string $key)
    {
        return \apcu_fetch($this->getCacheKey($key));
    }

    /**
     * Sets a cache resource in the APCu.
     * @param string $uri The resource uri (name of the resource inte scoutnet).
     * @param mixed $data The data to store.
     * @return mixed
     */
    private function setCacheResource(string $key, $data)
    {
        return \apcu_store($this->getCacheKey($key), $data, $this->cacheTtl);
    }

    /**
     * Builds a cache key from a uri
     * @param string $key
     * @return string
     */
    private function getCacheKey(string $key)
    {
        $groupId = $this->connection->getGroupConfig()->getGroupId();
        return __FILE__ . ":{$groupId}:{$key}";
    }
}
