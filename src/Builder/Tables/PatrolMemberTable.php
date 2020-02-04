<?php

namespace Scoutorg\Builder\Tables;

use Scoutorg\Builder\Bases\MemberBase;
use Scoutorg\Builder\Bases\PatrolBase;
use Scoutorg\Builder\Bases\PatrolMemberBase;
use Scoutorg\Builder\Bases\PatrolRoleBase;
use Scoutorg\Lib\OrgObject;
use Scoutorg\Lib\PatrolMember;

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
    public function get($source, $id)
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @param PatrolMemberBase $base 
     * @return PatrolMember
     */
    protected function build($source, $id, $base)
    {
        $patrol = $this->promiseLink($source, $id, 'patrol', PatrolBase::class);
        $member = $this->promiseLink($source, $id, 'member', MemberBase::class);
        $roles = $this->promiseList($source, $id, 'roles', PatrolRoleBase::class);

        return new PatrolMember(
            $source,
            $id,
            $patrol,
            $member,
            $roles
        );
    }
}
