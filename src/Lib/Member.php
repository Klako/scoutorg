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
 * @property-read OrgArray<int,Contact> $contacts
 * @property-read string $startDate
 * @property-read OrgArray<int,Troop> $troops
 * @property-read OrgArray<int,Patrol> $patrols
 * @property-read OrgArray<int,RoleGroup> $roleGroups
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
     * @param ContactArray<int,Contact> $contacts
     * @param string $startDate
     * @param TroopMemberArray<int,TroopMember> $troops
     * @param PatrolMemberArray<int,PatrolMember> $patrols
     * @param RoleGroupArray<int,RoleGroup> $roleGroups
     */
    public function __construct(
        $source,
        $id,
        $personInfo,
        $contactInfo,
        $home,
        $contacts,
        $startDate,
        $troops,
        $patrols,
        $roleGroups
    ) {
        parent::__construct($source, $id);
        $this->setProperty('personInfo', [PersonInfo::class], $personInfo);
        $this->setProperty('contactInfo', [ContactInfo::class], $contactInfo);
        $this->setProperty('home', [Location::class], $home);
        $this->setProperty('contacts', [OrgArray::class], $contacts);
        $this->setProperty('startDate', ['string'], $startDate);
        $this->setProperty('troops', [OrgArray::class], $troops);
        $this->setProperty('patrols', [OrgArray::class], $patrols);
        $this->setProperty('roleGroups', [OrgArray::class], $roleGroups);
    }
}
