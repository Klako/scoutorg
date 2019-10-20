<?php

namespace Scoutorg\Builder;

use Scoutorg\Lib;

class CustomListBuilder extends ObjectBuilder
{
    public function __construct($config, $source, $id, $scoutorg)
    {
        parent::__construct($config, $source, $id, $scoutorg);
    }

    public function build()
    {
        $builder = $this->builder;
        $customlist = $builder($this->id, 'base');

        $members = $this->buildList('members', 'member');
        $sublists = $this->buildList('sublists', 'customlist');

        return new Lib\CustomList(
            $this->source,
            $this->id,
            $customlist['title'],
            $customlist['description'],
            $members,
            $sublists
        );
    }
}