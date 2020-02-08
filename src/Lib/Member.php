<?php

/**
 * Contains Member class
 * @author Alexander Krantz
 */

namespace Scouterna\Scoutorg\Lib;

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
     * @param string $source
     * @param int|string $id
     * @param PersonInfo $personInfo
     * @param ContactInfo $contactInfo
     * @param Location $home
     * @param Arrays\ContactArray|IArrayPromise $contacts
     * @param string $startdate
     * @param Arrays\TroopMemberArray|IArrayPromise $troops
     * @param Arrays\PatrolMemberArray|IArrayPromise $patrols
     * @param Arrays\GroupMemberArray|IArrayPromise $groups
     * @param Arrays\GroupWaiterArray|IArrayPromise $waitGroups
     */
    public function __construct(
        string $source,
        $id,
        PersonInfo $personInfo,
        ContactInfo $contactInfo,
        Location $home,
        string $note,
        bool $leaderInterest,
        $contacts,
        $troops,
        $patrols,
        $groups,
        $waitGroups
    ) {
        parent::__construct($source, $id);
        $this->setProperty('personInfo', $personInfo);
        $this->setProperty('contactInfo', $contactInfo);
        $this->setProperty('home', $home);
        $this->setProperty('note', $note);
        $this->setProperty('leaderInterest', $leaderInterest);
        $this->setArray('contacts', $contacts, Arrays\ContactArray::class);
        $this->setArray('troops', $troops, Arrays\TroopMemberArray::class);
        $this->setArray('patrols', $patrols, Arrays\PatrolMemberArray::class);
        $this->setArray('groups', $groups, Arrays\GroupMemberArray::class);
        $this->setArray('waitGroups', $waitGroups, Arrays\GroupWaiterArray::class);
    }
}
