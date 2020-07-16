<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder\Bases\MemberBase;
use Scouterna\Scoutorg\Builder\Bases\TroopBase;
use Scouterna\Scoutorg\Builder\Bases\TroopMemberBase;
use Scouterna\Scoutorg\Builder\Bases\TroopRoleBase;
use Scouterna\Scoutorg\Model\TroopMember;

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
    public function get($uid)
    {
        return parent::get($uid);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @param TroopMemberBase $base 
     * @return TroopMember 
     */
    protected function build($uid, $base)
    {
        $troop = $this->promiseLink($uid, 'troop', TroopBase::class);
        $member = $this->promiseLink($uid, 'member', MemberBase::class);
        $roles = $this->promiseList($uid, 'roles', TroopRoleBase::class);

        return new TroopMember(
            $uid->getSource(),
            $uid->getId(),
            $troop,
            $member,
            $roles
        );
    }
}
