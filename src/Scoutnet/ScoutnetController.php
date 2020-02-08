<?php

/**
 * Contains ScoutnetController class
 * @author Alexander Krantz
 */

namespace Scouterna\Scoutorg\Scoutnet;

/**
 * Contains methods for getting data from scoutnet.
 */
class ScoutnetController
{
    /** @var string The url variables for fetching the waiting list. */
    const API_MEMBERLIST_WAITING_URLVARS = 'waiting=1';

    /** @var ScoutnetConnection The scoutnet connection. */
    private $connection;

    /** @var ICacheHandler */
    private $cacheHandler;

    /** @var int The ttl of the long lived cache in seconds. */
    private $cacheTtl;

    /**
     * Creates a new scoutnet group link.
     * @param ScoutnetConnection $connection
     */
    public function __construct(ScoutnetConnection $connection, $cacheHandler = null, int $cacheTtl = 0)
    {
        $this->connection = $connection;
        $this->cacheHandler = $cacheHandler;
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
        $cache = $this->getCacheResource('groupinfo');
        if ($cache) {
            return $cache;
        }

        $groupInfoObject = $this->connection->fetchGroupInfoApi();
        $groupInfo = new GroupInfo($groupInfoObject);

        $this->setCacheResource('groupinfo', $groupInfo);

        return $groupInfo;
    }

    /**
     * Gets the group member list.
     * @return Member[]
     */
    public function getMemberList()
    {
        $cache = $this->getCacheResource('members');
        if ($cache) {
            return $cache;
        }

        $memberList = $this->connection->fetchMemberListApi('');

        $members = [];
        foreach ($memberList->data as $id => $member) {
            $members[$id] = new Member($member);
        }

        $this->setCacheResource('members', $members);

        return $members;
    }

    /**
     * Gets the group waiting list.
     * @return WaitingMember[]|false
     */
    public function getWaitingList()
    {
        $cache = $this->getCacheResource('waitinglist');
        if ($cache) {
            return $cache;
        }

        $waitingList = $this->connection->fetchMemberListApi('waiting=1');

        $waitingMembers = [];
        foreach ($waitingList->data as $id => $waitingMember) {
            $waitingMembers[$id] = new WaitingMember($waitingMember);
        }

        $this->setCacheResource('waitinglist', $waitingMembers);

        return $waitingMembers;
    }

    /**
     * Gets all custom mailing lists from scoutnet.
     * @return CustomList[]
     */
    public function getCustomLists()
    {
        $cache = $this->getCacheResource('customlists');
        if ($cache) {
            return $cache;
        }

        $customListsResult = $this->connection->fetchCustomListsApi('');

        $customLists = [];
        foreach ($customListsResult as $id => $customList) {
            $customLists[$id] = new CustomList($customList);
        }

        $this->setCacheResource('customlists', $customLists);

        return $customLists;
    }

    /**
     * Gets all members in a custom mailinng list or one of its rules.
     * @param int $listId The custom mailing list id.
     * @param int $ruleId The rule id.
     * Leave to default (CustomListRuleEntry::NO_RULE_ID) if the whole mailing list is wanted.
     * @return CustomListMember[]
     */
    public function getCustomListMembers(int $listId, int $ruleId = CustomListRule::NO_RULE_ID)
    {
        $cache = $this->getCacheResource("customlistmembers:$listId:$ruleId");
        if ($cache) {
            return $cache;
        }

        $urlVars = $this->buildCustomListVars($listId, $ruleId);
        $memberList = $this->connection->fetchCustomListsApi($urlVars);

        $members = [];
        foreach ($memberList->data as $id => $member) {
            $members[$id] = new CustomListMember($member);
        }

        $this->setCacheResource("customlistmembers:$listId:$ruleId", $members);

        return $members;
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
     * Gets a cache resource.
     * @param string $uri The resource uri (name of the resource in scoutnet).
     * @return mixed
     */
    private function getCacheResource(string $key)
    {
        if ($this->cacheHandler) {
            return $this->cacheHandler->load($this->getCacheKey($key));
        }
        return false;
    }

    /**
     * Sets a cache resource.
     * @param string $uri The resource uri (name of the resource in scoutnet).
     * @param mixed $data The data to store.
     * @return mixed
     */
    private function setCacheResource(string $key, $data)
    {
        if ($this->cacheHandler) {
            return $this->cacheHandler->store($this->getCacheKey($key), $data, $this->cacheTtl);
        }
        return false;
    }

    /**
     * Builds a cache key from a uri
     * @param string $key
     * @return string
     */
    private function getCacheKey(string $key)
    {
        $groupId = $this->connection->getGroupConfig()->getGroupId();
        return "{$groupId}:{$key}";
    }
}
