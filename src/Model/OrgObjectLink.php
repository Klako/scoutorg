<?php

namespace Scouterna\Scoutorg\Model;

class OrgObjectLink
{
    private $orgObject;
    private $metaInfos;

    public function __construct(OrgObject $orgObject, array $metaInfos)
    {
        $this->orgObject = $orgObject;
        $this->metaInfos = $metaInfos;
    }

    /**
     * @return OrgObject 
     */
    public function getObject()
    {
        return $this->orgObject;
    }

    /**
     * @return LinkMetaInfo[] 
     */
    public function getMetaInfos()
    {
        return $this->metaInfos;
    }
}
