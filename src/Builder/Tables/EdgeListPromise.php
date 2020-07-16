<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder;
use Scouterna\Scoutorg\Model;

class EdgeListPromise implements Model\IArrayPromise
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

    /** @var string */
    private $edgeType;

    public function __construct($config, $scoutorg, $uid, $fromType, $name, $toType, $edgeType)
    {
        $this->config = $config;
        $this->scoutorg = $scoutorg;
        $this->uid = $uid;
        $this->type = $fromType;
        $this->name = $name;
        $this->toType = $toType;
        $this->edgeType = $edgeType;
    }

    public function getArray(): Model\OrgArray
    {
        $table = $this->scoutorg->getTable($this->toType);
        $edgeTable = $this->scoutorg->getTable($this->edgeType);
        $arrayBuilder = new OrgArrayBuilder();
        foreach ($this->config->providers() as $provider) {
            $links = $provider->getLinkParts($this->uid, $this->type, $this->name);
            foreach ($links as $link) {
                Model\Helper::checkType('link', $link, [Builder\Link::class]);
                if ($link->getEdge() == null){
                    continue;
                }
                $edge = $edgeTable->get($link->getEdge());
                $object = $table->get($link->getTarget());
                if ($edge && $object) {
                    $arrayBuilder->addObject($edge, $link->getTarget());
                }
            }
        }
        return $arrayBuilder->build($this->edgeType::ARRAY_TYPE);
    }
}
