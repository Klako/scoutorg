<?php

namespace Scouterna\Scoutorg\Model;

/**
 * @property-read string $source
 * @property-read Uid $uid
 */
class LinkMetaInfo extends ReadOnlyObject
{
    public function __construct(string $source, Uid $uid)
    {
        parent::__construct();
        $this->setProperty('source', $source);
        $this->setProperty('uid', $uid);
    }
}
