<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder;
use Scouterna\Scoutorg\Model;

class ListPromise implements Model\IArrayPromise
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

    /** @var callable */
    private $postProcess;

    public function __construct(
        $config,
        $scoutorg,
        $uid,
        $fromType,
        $name,
        $toType,
        $postProcess = null
    ) {
        $this->config = $config;
        $this->scoutorg = $scoutorg;
        $this->uid = $uid;
        $this->type = $fromType;
        $this->name = $name;
        $this->toType = $toType;
        $this->postProcess = $postProcess;
    }

    public function getArray(): Model\OrgArray
    {
        $table = $this->scoutorg->getTable($this->toType);
        $arrayBuilder = new OrgArrayBuilder();
        foreach ($this->config->providers() as $source => $provider) {
            $links = $provider->getLinkParts($this->uid, $this->type, $this->name);
            foreach ($links as $link) {
                Model\Helper::checkType('link', $link, [Builder\Link::class]);
                $object = $table->get($link->getTarget());
                if ($object) {
                    $arrayBuilder->addObject($object, $source);
                }
            }
        }
        if ($this->postProcess){
            ($this->postProcess)($arrayBuilder);
        }
        return $arrayBuilder->build();
    }
}
