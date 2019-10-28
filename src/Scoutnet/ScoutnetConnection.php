<?php

/**
 * Contains ScoutnetConnection class
 * @author Alexander Krantz
 */

namespace Scoutorg\Scoutnet;

use pcrov\JsonReader\JsonReader;

/**
 * A scoutnet connection for fetching data from scoutnet.
 * Also handles cache.
 */
class ScoutnetConnection
{
    /** @var string The api path for fetching group info */
    const API_GROUPINFO_PATH = 'api/organisation/group';

    /** @var string The api path for fetching custom lists */
    const API_CUSTOMLISTS_PATH = 'api/group/customlists';

    /** @var string The api path for fetching member lists */
    const API_MEMBERLIST_PATH = 'api/group/memberlist';

    /** @var string The domain/address of the server with the scoutnet api. */
    private $domain;

    /** @var ScoutGroupConfig The scoutnet group configuration. */
    private $groupConfig;

    /**
     * Creates a new connection.
     * @param ScoutGroupConfig $groupConfig
     * @param string $domain
     * @param int $cacheLifeTime
     */
    public function __construct(ScoutGroupConfig $groupConfig, string $domain = 'www.scoutnet.se')
    {
        $this->groupConfig = $groupConfig;
        $this->domain = $domain;
    }

    /**
     * Gets the domain to be used.
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * Sets the domain to be used.
     * @param string $domain
     * @return void
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
    }

    /**
     * Gets the scout group configuration.
     * @return ScoutGroupConfig
     */
    public function getGroupConfig()
    {
        return $this->groupConfig;
    }

    public function fetchGroupInfoApi() {
        $groupInfoKey = $this->groupConfig->getGroupInfoKey();
        $uri = $this->getApiQuery(self::API_GROUPINFO_PATH, '');
        $groupInfoReader = $this->fetchWebPage($groupInfoKey, $uri);

        return $groupInfoReader;
    }

    /**
     * Fetches the resulting json object using
     * the scoutnet server's member list api.
     * @param string $urlVars The uri variables to apply.
     * @param bool $force Wether to force to fetch and cache.
     * @return JsonReader
     */
    public function fetchMemberListApi(string $urlVars)
    {
        $memberListKey = $this->groupConfig->getMemberListKey();
        $uri = $this->getApiQuery(self::API_MEMBERLIST_PATH, $urlVars);
        $memberListReader = $this->fetchWebPage($memberListKey, $uri);

        return $memberListReader;
    }

    /**
     * Fetches the resulting json object using
     * the scoutnet server's custom list api.
     * @param string $urlVars The uri variables to apply.
     * @return JsonReader
     */
    public function fetchCustomListsApi(string $urlVars)
    {
        $customListsKey = $this->groupConfig->getCustomListsKey();
        $uri = $this->getApiQuery(self::API_CUSTOMLISTS_PATH, $urlVars);
        $customListReader = $this->fetchWebPage($customListsKey, $uri);

        return $customListReader;
    }

    /**
     * Fetches a webpage from the url.
     * @param string $apiKey
     * @param string $apiQuery
     * @return JsonReader
     */
    private function fetchWebPage(string $apiKey, string $apiQuery)
    {
        $url = $this->getApiUrl($apiKey, $apiQuery);
        $jsonReader = new JsonReader();
        $jsonReader->open($url);
        return $jsonReader;
    }

    /**
     * Builds a uri for a resource to be fetched from the scoutnet api.
     * @param string $apiPath
     * @param string $urlVars
     * @return string
     */
    private function getApiQuery(string $apiPath, string $urlVars)
    {
        return "{$apiPath}?{$urlVars}&format=json";
    }

    /**
     * Builds a url for fetching a page from the scoutnet api.
     * @param string $apiKey
     * @param string $apiQuery
     * @return string
     */
    private function getApiUrl(string $apiKey, string $apiQuery)
    {
        $groupId = $this->groupConfig->getGroupId();
        return "https://{$groupId}:{$apiKey}@{$this->domain}/{$apiQuery}";
    }
}
