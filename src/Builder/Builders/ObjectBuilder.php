<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Builder;
use Scoutorg\Builder\Configs;

abstract class ObjectBuilder
{
    protected $config;
    /** @var Builder\ScoutorgBuilder $scoutorg */
    protected $scoutorg;

    protected function __construct($config, $scoutorg)
    {
        $this->config = $config;
        $this->scoutorg = $scoutorg;
    }

    public abstract function build($source, $id);

    protected function buildList($buildermethod, $scoutorgtype, $source, $id)
    {
        return function ($that) use ($buildermethod, $scoutorgtype, $source, $id) {
            $array = new OrgArrayBuilder();
            $builders = $this->config['builders'];
            foreach ($builders as $builder) {
                /** @var Configs\Uid[] $relations */
                $relations = $builder($source, $id, $buildermethod);
                foreach ($relations as $relation) {
                    $orgObject = $this->scoutorg->get($scoutorgtype, $relation->source, $relation->id);
                    if ($orgObject) {
                        $array->addObject($orgObject);
                    } else {
                        // TODO: Send error, orgobject doesn't exist.
                    }
                }
            }
            return $array->build();
        };
    }

    protected function buildLinkList($buildermethod, $scoutorgtype, $source, $id)
    {
        return function ($that) use ($buildermethod, $scoutorgtype, $source, $id) {
            $array = new OrgArrayBuilder();
            $builders = $this->config['builders'];
            foreach ($builders as $builder) {
                /** @var Configs\LinkUid[] $relations */
                $relations = $builder($source, $id, $buildermethod);
                foreach ($relations as $relation) {
                    $orgObject = $this->scoutorg->get($scoutorgtype, $relation->source, $relation->id);
                    if ($orgObject) {
                        $array->addObject($orgObject, [
                            'source' => $relation->target->source,
                            'id' => $relation->target->id
                        ]);
                    } else {
                        // TODO: Send error, orgobject doesn't exist.
                    }
                }
            }
        };
    }

    protected function buildSingle($buildermethod, $scoutorgtype, $source, $id)
    {
        return function ($that) use ($buildermethod, $scoutorgtype, $source, $id) {
            $builders = $this->config['builders'];
            /** @var Configs\Uid|bool $relation */
            $relation = false;
            foreach ($builders as $builder) {
                $result = $builder($source, $id, $buildermethod);
                if ($result && !$relation) { // Result and no existing relation
                    $relation = $result;
                } elseif ($result) { // Result and existing relation
                    // TODO: Send error, more than one relation from several different sources
                }
            }
            if (!$relation) {
                return null;
            }
            $orgObject = $this->scoutorg->get($scoutorgtype, $relation->source, $relation->id);
            if (!$orgObject) {
                // TODO: Send error, orgobject doesn't exist.
                return null;
            }
            return $orgObject;
        };
    }
}
