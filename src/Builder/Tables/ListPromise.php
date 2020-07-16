<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder;
use Scouterna\Scoutorg\Lib\IArrayPromise;

class ListPromise implements IArrayPromise
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

    public function getArray(): \Scouterna\Scoutorg\Lib\OrgArray
    {
        $table = $this->scoutorg->getTable($this->toType);
        $arrayBuilder = new OrgArrayBuilder();
        foreach ($this->config->providers() as $provider) {
            $uids = $provider->getLinkParts($this->uid, $this->type, $this->name);
            foreach ($uids as $uid) {
                Builder\Helper::checkType('uid', $uid, [Builder\Uid::class]);
                $object = $table->get($uid);
                if ($object) {
                    $arrayBuilder->addObject($object);
                }
            }
        }
        return $arrayBuilder->build($this->toType::ARRAY_TYPE);
    }
}
