<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;
use Scoutorg\Builder\Configs;

class BranchBuilder extends ObjectBuilder
{
    public function __construct($config, $source, $id, $scoutorg)
    {
        parent::__construct($config, $source, $id, $scoutorg);
    }

    public function build()
    {
        $builder = $this->builder;
        /** @var Configs\BranchBase $base */
        $base = $builder($this->source, $this->id, 'base');

        $troops = $this->buildList('troops', 'troop');

        return new Lib\Branch(
            $this->source,
            $this->id,
            $base->name,
            $troops
        );
    }
}