<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;
use Scoutorg\Builder\Configs;

class CustomListBuilder extends ObjectBuilder
{
    public function __construct($config, $source, $id, $scoutorg)
    {
        parent::__construct($config, $source, $id, $scoutorg);
    }

    public function build()
    {
        $builder = $this->builder;
        /** @var Configs\CustomListBase $base */
        $base = $builder($this->source, $this->id, 'base');

        $members = $this->buildList('members', 'member');
        $sublists = $this->buildList('sublists', 'customlist');

        return new Lib\CustomList(
            $this->source,
            $this->id,
            $base->title,
            $base->description,
            $members,
            $sublists
        );
    }
}