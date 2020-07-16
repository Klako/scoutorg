<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder\Bases\GroupMemberBase;
use Scouterna\Scoutorg\Builder\Bases\GroupRoleBase;
use Scouterna\Scoutorg\Builder\Bases\MemberBase;
use Scouterna\Scoutorg\Builder\Bases\ScoutGroupBase;
use Scouterna\Scoutorg\Model\GroupMember;

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
    public function get($uid)
    {
        return parent::get($uid);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @param GroupMemberBase $base 
     * @return GroupMember
     */
    protected function build($uid, $base)
    {
        $group = $this->promiseLink($uid, 'group', ScoutGroupBase::class);
        $member = $this->promiseLink($uid, 'member', MemberBase::class);
        $roles = $this->promiseList($uid, 'roles', GroupRoleBase::class);

        return new GroupMember(
            $uid->getSource(),
            $uid->getId(),
            $base->getStartdate(),
            $group,
            $member,
            $roles
        );
    }
}
