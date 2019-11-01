<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;
use Scoutorg\Builder\Configs;

class CustomListBuilder extends ObjectBuilder
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg);
    }

    public function build($source, $id)
    {
        $builder = $this->config['builders'][$source];
        /** @var Configs\CustomListBase $base */
        $base = $builder($source, $id, 'base');

        $members = $this->buildList('members', Lib\Member::class, $source, $id);
        $sublists = $this->buildList('sublists', Lib\CustomList::class, $source, $id);

        return new Lib\CustomList(
            $source,
            $id,
            $base->title,
            $base->description,
            $members,
            $sublists
        );
    }
}