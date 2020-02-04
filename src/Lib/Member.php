<?php

/**
 * Contains Member class
 * @author Alexander Krantz
 */

namespace Scoutorg\Lib;

/**
 * A scout member with various personal and group info.
 * @property-read PersonInfo $personInfo
 * @property-read ContactInfo $contactInfo
 * @property-read Location $home
 * @property-read string $note
 * @property-read bool $leaderInterest
 * @property-read OrgArray<int,Contact> $contacts
 * @property-read OrgArray<int,Troop> $troops
 * @property-read OrgArray<int,Patrol> $patrols
 * @property-read OrgArray<int,GroupRole> $groupRoles
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
     * @param Arrays\ContactArray<Contact> $contacts
     * @param string $startdate
     * @param Arrays\TroopMemberArray<TroopMember> $troops
     * @param Arrays\PatrolMemberArray<PatrolMember> $patrols
     * @param Arrays\GroupMemberArray<GroupMember> $groups
     * @param Arrays\GroupWaiterArray<GroupWaiter> $waitGroups
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
