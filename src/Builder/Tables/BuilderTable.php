<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder;
use Scouterna\Scoutorg\Model\OrgObject;
use Scouterna\Scoutorg\Model\Uid;

abstract class BuilderTable
{
    /** @var MutableOrgArray */
    private $table;

    /** @var Builder\Config */
    protected $config;

    /** @var Builder\ScoutorgBuilder */
    protected $scoutorg;

    /** @var string */
    protected $type;

    public function __construct($config, $scoutorg, $type)
    {
        $this->table = new MutableOrgArray([]);
        $this->config = $config;
        $this->scoutorg = $scoutorg;
        $this->type = $type;
    }

    /**
     * @param Uid $uid
     * @return OrgObject|null
     */
    public function get(Uid $uid)
    {
        if (!$this->table->exists($uid)) {
            $orgObject = $this->preBuild($uid);
            // TODO: error on null
            if ($orgObject) {
                $this->table->insert($orgObject);
            }
        }

        return $this->table->get($uid);
    }

    private function preBuild($uid)
    {
        $provider = $this->config->getProvider($uid->getSource());
        if (!$provider) {
            return null;
        }
        $base = $provider->getBasePart($uid->getId(), $this->type);
        if (!$base) {
            return null;
        }
        return $this->build($uid, $base);
    }

    /**
     * @param Uid $uid 
     * @param Bases\ObjectBase $base 
     * @return \Scouterna\Scoutorg\Model\OrgObject 
     */
    protected abstract function build($uid, $base);

    protected function promiseList($uid, $name, $type, $postProcess = null)
    {
        return new ListPromise(
            $this->config,
            $this->scoutorg,
            $uid,
            $this->type,
            $name,
            $type,
            $postProcess
        );
    }

    protected function promiseEdgeList($uid, $name, $type, $edgeType, $postProcess = null)
    {
        return new EdgeListPromise(
            $this->config,
            $this->scoutorg,
            $uid,
            $this->type,
            $name,
            $type,
            $edgeType,
            $postProcess
        );
    }

    protected function promiseLink($uid, $name, $type)
    {
        return new LinkPromise(
            $this->config,
            $this->scoutorg,
            $uid,
            $this->type,
            $name,
            $type
        );
    }
}
