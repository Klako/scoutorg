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
    /**
     * @internal
     */
    public function __construct(
        Uid $uid,
        string $waitingSince,
        IObjectPromise $group,
        IObjectPromise $member
    ) {
        parent::__construct($uid);
        $this->setProperty('waitingSince', $waitingSince);
        $this->setObject('group', $group);
        $this->setObject('member', $member);
    }
}
