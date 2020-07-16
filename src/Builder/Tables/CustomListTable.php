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
    public function get($uid)
    {
        return parent::get($uid);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @param CustomListBase $base 
     * @return CustomList
     */
    protected function build($uid, $base)
    {
        $subLists = $this->promiseList($uid, 'sublists', CustomListBase::class);
        $members = $this->promiseList($uid, 'members', MemberBase::class);

        return new CustomList(
            $uid->getSource(),
            $uid->getId(),
            $base->getTitle(),
            $base->getDescription(),
            $members,
            $subLists
        );
    }
}
