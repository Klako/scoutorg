<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;
use Scoutorg\Builder\Configs;

class BranchBuilder extends ObjectBuilder
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg);
    }

    public function build($source, $id)
    {
        $builder = $this->config['builders'][$source];
        /** @var Configs\BranchBase $base */
        $base = $builder($source, $id, 'base');

        $troops = $this->buildList('troops', Lib\Troop::class, $source, $id);

        return new Lib\Branch(
            $source,
            $id,
            $base->name,
            $troops
        );
    }
}
