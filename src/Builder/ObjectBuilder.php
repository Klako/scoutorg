<?php

namespace Scoutorg\Builder;

class ObjectBuilder
{
    protected $config;
    /** @var callable $builder */
    protected $builder;
    protected $source, $id;
    /** @var ScoutorgBuilder $scoutorg */
    protected $scoutorg;

    protected function __construct($config, $source, $id, $scoutorg)
    {
        $this->config = $config;
        $this->builder = $config['builders'][$source];
        $this->source = $source;
        $this->id = $id;
        $this->scoutorg = $scoutorg;
    }

    public abstract function build();

    protected function buildList($buildermethod, $scoutorgtype, $isIntermediary = false)
    {
        return function ($that) use ($buildermethod, $scoutorgtype, $isIntermediary) {
            $array = new OrgArrayBuilder();
            $builders = $this->config['builders'];
            foreach ($builders as $builder) {
                $relations = $builder($this->source, $this->id, $buildermethod);
                foreach ($relations as $relation) {
                    $orgObject = $this->scoutorg->get($scoutorgtype, $relation['source'], $relation['id']);
                    if ($orgObject) {
                        if ($isIntermediary) {
                            $forcedIndex = $relation['target'];
                        } else {
                            $forcedIndex = null;
                        }
                        $array->addObject($orgObject, $forcedIndex);
                    } else {
                        // TODO: Send error, orgobject doesn't exist.
                    }
                }
            }
            return $array->build();
        };
    }

    protected function buildSingle($buildermethod, $scoutorgtype)
    {
        return function ($that) use ($buildermethod, $scoutorgtype) {
            $builders = $this->config['builders'];
            $relation = false;
            foreach ($builders as $builder) {
                $result = $builder($this->source, $this->id, $buildermethod);
                if ($result && !$relation) { // Result and no existing relation
                    $relation = $result;
                } elseif ($result) { // Result and existing relation
                    // TODO: Send error, more than one relation from several different sources
                }
            }
            if (!$relation) {
                return null;
            }
            $orgObject = $this->scoutorg->get($scoutorgtype, $relation['source'], $relation['id']);
            if (!$orgObject) {
                // TODO: Send error, orgobject doesn't exist.
                return null;
            }
            return $orgObject;
        };
    }
}
