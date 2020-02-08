<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder\Bases\GroupMemberBase;
use Scouterna\Scoutorg\Builder\Bases\GroupRoleBase;
use Scouterna\Scoutorg\Builder\Bases\MemberBase;
use Scouterna\Scoutorg\Builder\Bases\ScoutGroupBase;
use Scouterna\Scoutorg\Lib\GroupMember;

class GroupMemberTable extends BuilderTable
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg, GroupMemberBase::class);
    }

    /**
     * 
     * @param string $source 
     * @param int|string $id 
     * @return GroupMember 
     */
    public function get($source, $id)
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @param GroupMemberBase $base 
     * @return GroupMember
     */
    protected function build($source, $id, $base)
    {
        $group = $this->promiseLink($source, $id, 'group', ScoutGroupBase::class);
        $member = $this->promiseLink($source, $id, 'member', MemberBase::class);
        $roles = $this->promiseList($source, $id, 'roles', GroupRoleBase::class);

        return new GroupMember(
            $source,
            $id,
            $base->getStartdate(),
            $group,
            $member,
            $roles
        );
    }
}
