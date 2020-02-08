<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder;
use Scouterna\Scoutorg\Lib\OrgObject;

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
     * @param string $source 
     * @param int|string $id 
     * @return OrgObject 
     * @throws \OutOfRangeException 
     */
    public function get($source, $id)
    {
        if (!$this->table->exists($source, $id)) {
            $orgObject = $this->preBuild($source, $id);
            // TODO: error on null
            if ($orgObject) {
                $this->table->insert($orgObject);
            }
        }

        return $this->table->get($source, $id);
    }

    private function preBuild($source, $id)
    {
        $provider = $this->config->getProvider($source);
        if (!$provider) {
            return null;
        }
        $base = $provider->getBasePart($id, $this->type);
        if (!$base) {
            return null;
        }
        return $this->build($source, $id, $base);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @param Bases\ObjectBase $base 
     * @return \Scouterna\Scoutorg\Lib\OrgObject 
     */
    protected abstract function build($source, $id, $base);

    protected function promiseList($source, $id, $name, $type)
    {
        return new ListPromise(
            $this->config,
            $this->scoutorg,
            new Builder\Uid($source, $id),
            $this->type,
            $name,
            $type
        );
    }

    protected function promiseEdgeList($source, $id, $name, $type, $edgeType)
    {
        return new EdgeListPromise(
            $this->config,
            $this->scoutorg,
            new Builder\Uid($source, $id),
            $this->type,
            $name,
            $type,
            $edgeType
        );
    }

    protected function promiseLink($source, $id, $name, $type)
    {
        return new LinkPromise(
            $this->config,
            $this->scoutorg,
            new Builder\Uid($source, $id),
            $this->type,
            $name,
            $type
        );
    }
}
