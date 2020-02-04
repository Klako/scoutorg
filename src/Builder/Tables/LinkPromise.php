<?php

namespace Scoutorg\Builder\Tables;

use Scoutorg\Builder;
use Scoutorg\Lib\IObjectPromise;

class LinkPromise implements IObjectPromise
{
    /** @var Builder\Config */
    private $config;

    /** @var Builder\ScoutorgBuilder */
    private $scoutorg;

    /** @var Builder\Uid */
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

    public function getObject(): \Scoutorg\Lib\OrgObject
    {
        $primarySource = $this->uid->getSource();
        $table = $this->scoutorg->getTable($this->toType);
        $object = null;
        foreach ($this->config->providers() as $source => $provider) {
            $uid = $provider->getLinkPart($this->uid, $this->type, $this->name);
            if (($uid && !$object) || $primarySource == $source) {
                $object = $table->get($uid->getSource(), $uid->getId());
            }
        }
        return $object;
    }
}
