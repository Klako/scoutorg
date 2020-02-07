<?php

namespace Scoutorg\Builder\Tables;

use Scoutorg\Builder\Bases\MemberBase;
use Scoutorg\Builder\Bases\TroopBase;
use Scoutorg\Builder\Bases\TroopMemberBase;
use Scoutorg\Builder\Bases\TroopRoleBase;
use Scoutorg\Lib\OrgObject;
use Scoutorg\Lib\TroopMember;

class TroopMemberTable extends BuilderTable
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg, TroopMemberBase::class);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @return TroopMember 
     * @throws \OutOfRangeException 
     */
    public function get($source, $id)
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @param TroopMemberBase $base 
     * @return TroopMember 
     */
    protected function build($source, $id, $base)
    {
        $troop = $this->promiseLink($source, $id, 'troop', TroopBase::class);
        $member = $this->promiseLink($source, $id, 'member', MemberBase::class);
        $roles = $this->promiseList($source, $id, 'roles', TroopRoleBase::class);

        return new TroopMember(
            $source,
            $id,
            $troop,
            $member,
            $roles
        );
    }
}