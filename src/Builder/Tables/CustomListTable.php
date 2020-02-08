<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder\Bases\CustomListBase;
use Scouterna\Scoutorg\Builder\Bases\MemberBase;
use Scouterna\Scoutorg\Lib\CustomList;

class CustomListTable extends BuilderTable
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg, CustomListBase::class);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @return CustomList 
     * @throws \OutOfRangeException 
     */
    public function get($source, $id)
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @param CustomListBase $base 
     * @return CustomList
     */
    protected function build($source, $id, $base)
    {
        $subLists = $this->promiseList($source, $id, 'sublists', CustomListBase::class);
        $members = $this->promiseList($source, $id, 'members', MemberBase::class);

        return new CustomList(
            $source,
            $id,
            $base->getTitle(),
            $base->getDescription(),
            $members,
            $subLists
        );
    }
}
