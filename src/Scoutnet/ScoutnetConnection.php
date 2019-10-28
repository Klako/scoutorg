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
        $url = $this->getApiUrl($groupInfoKey, self::API_GROUPINFO_PATH, '');
        $result = $this->performPageRequest($url);
        if ($result === false) {
            return false;
        }
        return \json_decode($result);
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
        $url = $this->getApiUrl($memberListKey, self::API_MEMBERLIST_PATH, $urlVars);
        $result = $this->performPageRequest($url);
        if ($result === false) {
            return false;
        }
        return \json_decode($result);
    }

    /**
     * Fetches the resulting json object using
     * the scoutnet server's custom list api.
     * @param string $urlVars The uri variables to apply.
     * @return string|false
     */
    public function fetchCustomListsApi(string $urlVars)
    {
        $customListsKey = $this->groupConfig->getCustomListsKey();
        $url = $this->getApiUrl($customListsKey, self::API_CUSTOMLISTS_PATH, $urlVars);
        $result = $this->performPageRequest($url);
        if ($result === false) {
            return false;
        }
        return \json_decode($result);
    }

    /**
     * Performs one page request.
     * @param string $url
     * @return string|false
     */
    private function performPageRequest(string $url) {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_URL => $url,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_RETURNTRANSFER => true,
        ]);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }

    /**
     * Builds a url for fetching a page from the scoutnet api.
     * @param string $apiKey
     * @param string $apiPath
     * @param string $urlVars
     * @return string
     */
    private function getApiUrl(string $apiKey, string $apiPath, string $urlVars)
    {
        $groupId = $this->groupConfig->getGroupId();
        return "https://{$groupId}:{$apiKey}@{$this->domain}/{$apiPath}?{$urlVars}&format=json";
    }
}
