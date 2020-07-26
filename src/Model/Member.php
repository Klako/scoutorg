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
 * @property-read Arrays\ContactArray<mixed,Contact> $contacts
 * @property-read Arrays\TroopMemberArray<mixed,Troop> $troops
 * @property-read Arrays\PatrolMemberArray<mixed,Patrol> $patrols
 * @property-read Arrays\GroupMemberArray<mixed,GroupMember> $groups
 * @property-read Arrays\GroupWaiterArray<mixed,GroupWaiter> $waitGroups
 */
class Member extends OrgObject
{
    /**
     * Creates a new member.
     * @internal
     * @param Uid $uid
     * @param PersonInfo $personInfo
     * @param ContactInfo $contactInfo
     * @param Location $home
     * @param IArrayPromise $contacts
     * @param string $startdate
     * @param IArrayPromise $troops
     * @param IArrayPromise $patrols
     * @param IArrayPromise $groups
     * @param IArrayPromise $waitGroups
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
