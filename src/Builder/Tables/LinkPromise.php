<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder;
use Scouterna\Scoutorg\Model;

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

    public function getObject(): ?Model\OrgObject
    {
        $primarySource = $this->uid->getSource();
        $table = $this->scoutorg->getTable($this->toType);
        $object = null;
        foreach ($this->config->providers() as $source => $provider) {
            $link = $provider->getLinkPart($this->uid, $this->type, $this->name);
            if ($link == null){
                return null;
            }
            if (($link && !$object) || $primarySource == $source) {
                $object = $table->get($link->getTarget());
            }
        }
        return $object;
    }
}
