<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder\Bases\MemberBase;
use Scouterna\Scoutorg\Builder\Bases\PatrolBase;
use Scouterna\Scoutorg\Builder\Bases\PatrolMemberBase;
use Scouterna\Scoutorg\Builder\Bases\PatrolRoleBase;
use Scouterna\Scoutorg\Lib\PatrolMember;

class PatrolMemberTable extends BuilderTable
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg, PatrolMemberBase::class);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @return PatrolMember 
     * @throws \OutOfRangeException 
     */
    public function get($uid)
    {
        return parent::get($uid);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @param PatrolMemberBase $base 
     * @return PatrolMember
     */
    protected function build($uid, $base)
    {
        $patrol = $this->promiseLink($uid, 'patrol', PatrolBase::class);
        $member = $this->promiseLink($uid, 'member', MemberBase::class);
        $roles = $this->promiseList($uid, 'roles', PatrolRoleBase::class);

        return new PatrolMember(
            $uid->getSource(),
            $uid->getId(),
            $patrol,
            $member,
            $roles
        );
    }
}
