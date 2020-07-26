<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder;
use Scouterna\Scoutorg\Model;

class EdgeListPromise implements Model\IEdgeArrayPromise
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

    public function getArray(): Model\OrgEdgeArray
    {
        $edgeTable = $this->scoutorg->getTable($this->edgeType);
        $targetTable = $this->scoutorg->getTable($this->toType);
        $arrayBuilder = new OrgEdgeArrayBuilder();
        foreach ($this->config->providers() as $provider) {
            $links = $provider->getLinkParts($this->uid, $this->type, $this->name);
            foreach ($links as $link) {
                Model\Helper::checkType('link', $link, [Builder\Link::class]);
                if ($link->getEdge() == null) {
                    continue;
                }
                $edge = $edgeTable->get($link->getEdge());
                $target = $targetTable->get($link->getTarget());
                if ($edge && $target) {
                    $arrayBuilder->addObject($edge, $target);
                }
            }
        }
        return $arrayBuilder->build();
    }
}
