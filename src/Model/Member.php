<?php

/**
 * Contains Member class
 * @author Alexander Krantz
 */

namespace Scouterna\Scoutorg\Model;

/**
 * A scout member with various personal and group info.
 * @property-read PersonInfo $personInfo
 * @property-read ContactInfo $contactInfo
 * @property-read Location $home
 * @property-read string $note
 * @property-read bool $leaderInterest
 * @property-read Arrays\ContactArray<string,Contact> $contacts
 * @property-read Arrays\MemberTroopArray<string,TroopMember> $troops
 * @property-read Arrays\MemberPatrolArray<string,PatrolMember> $patrols
 * @property-read Arrays\MemberGroupArray<string,GroupMember> $groups
 * @property-read Arrays\WaiterGroupArray<string,GroupWaiter> $waitGroups
 */
class Member extends OrgObject
{
    /**
     * Creates a new member.
     * @internal
     */
    public function __construct(
        Uid $uid,
        PersonInfo $personInfo,
        ContactInfo $contactInfo,
        Location $home,
        string $note,
        bool $leaderInterest,
        IArrayPromise $contacts,
        IEdgeArrayPromise $troops,
        IEdgeArrayPromise $patrols,
        IEdgeArrayPromise $groups,
        IEdgeArrayPromise $waitGroups
    ) {
        parent::__construct($uid);
        $this->setProperty('personInfo', $personInfo);
        $this->setProperty('contactInfo', $contactInfo);
        $this->setProperty('home', $home);
        $this->setProperty('note', $note);
        $this->setProperty('leaderInterest', $leaderInterest);
        $this->setArray('contacts', $contacts);
        $this->setEdgeArray('troops', $troops);
        $this->setEdgeArray('patrols', $patrols);
        $this->setEdgeArray('groups', $groups);
        $this->setEdgeArray('waitGroups', $waitGroups);
    }
}
