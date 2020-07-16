<?php

namespace Scouterna\Scoutorg\Model;

/**
 * A member who's in the waiting list of a groupp.
 * @property-read string $waitingSince
 * @property-read ScoutGroup $group
 * @property-read Member $member
 */
class GroupWaiter extends OrgObject
{
    public function __construct(Uid $uid, string $waitingSince, $group, $member)
    {
        parent::__construct($uid);
        $this->setProperty('waitingSince', $waitingSince);
        $this->setObject('group', $group, ScoutGroup::class);
        $this->setObject('member', $member, Member::class);
    }
}
