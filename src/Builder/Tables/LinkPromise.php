<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder;
use Scouterna\Scoutorg\Model;
use Scouterna\Scoutorg\Model\LinkMetaInfo;
use Scouterna\Scoutorg\Model\OrgObjectLink;

class LinkPromise implements Model\IObjectPromise
{
    /** @var Builder\Config */
    private $config;

    /** @var Builder\ScoutorgBuilder */
    private $scoutorg;

    /** @var Model\Uid */
    private $uid;

    /** @var string */
    private $type;

    /** @var string */
    private $name;

    /** @var string */
    private $toType;

    public function __construct($config, $scoutorg, $uid, $fromType, $name, $toType)
    {
        $this->config = $config;
        $this->scoutorg = $scoutorg;
        $this->uid = $uid;
        $this->type = $fromType;
        $this->name = $name;
        $this->toType = $toType;
    }

    public function getObjectLink(): ?Model\OrgObjectLink
    {
        $primarySource = $this->uid->getSource();
        $table = $this->scoutorg->getTable($this->toType);
        $object = null;
        $metaInfos = [];
        foreach ($this->config->providers() as $source => $provider) {
            $link = $provider->getLinkPart($this->uid, $this->type, $this->name);
            if ($link) {
                $metaInfos[$source] = new LinkMetaInfo($source, $link->getTarget());
                if (!$object || $primarySource == $source) {
                    $object = $table->get($link->getTarget());
                }
            }
        }
        return $object ? new OrgObjectLink($object, $metaInfos) : null;
    }
}
