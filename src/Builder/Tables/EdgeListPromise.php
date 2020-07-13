<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder;
use Scouterna\Scoutorg\Lib\IArrayPromise;

class EdgeListPromise implements IArrayPromise
{
    /** @var Builder\Config */
    private $config;

    /** @var Builder\Scouterna\ScoutorgBuilder */
    private $scoutorg;

    /** @var Builder\Uid */
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

    public function getArray(): \Scouterna\Scoutorg\Lib\OrgArray
    {
        $table = $this->scoutorg->getTable($this->toType);
        $edgeTable = $this->scoutorg->getTable($this->edgeType);
        $arrayBuilder = new OrgArrayBuilder();
        foreach ($this->config->providers() as $provider) {
            /** @var Builder\EdgeUid[] $edgeUids */
            $edgeUids = $provider->getLinkParts($this->uid, $this->type, $this->name);
            foreach ($edgeUids as $edgeUid) {
                $uid = $edgeUid->getTarget();
                Builder\Helper::checkType('edgeUid', $edgeUid, [Builder\EdgeUid::class]);
                $edge = $edgeTable->get($edgeUid->getSource(), $edgeUid->getId());
                $object = $table->get($uid->getSource(), $uid->getId());
                if ($edge && $object) {
                    $arrayBuilder->addObject($edge, $uid);
                }
            }
        }
        return $arrayBuilder->build($this->edgeType::ARRAY_TYPE);
    }
}
