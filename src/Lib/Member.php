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
     * @param IObjectMutator $mutator
     * @param int $id
     * @param PersonInfo $personInfo
     * @param ContactInfo $contactInfo
     * @param Location $home
     * @param OrgArray<int,Contact>|IPropertyProvider $contacts
     * @param string $startDate
     * @param OrgArray<int,Troop>|IPropertyProvider $troops
     * @param OrgArray<int,Patrol>|IPropertyProvider $patrols
     * @param OrgArray<int,RoleGroup>|IPropertyProvider $roleGroups
     */
    public function __construct(
        IObjectMutator $mutator,
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
        parent::__construct($mutator, $id);
        $this->setProperty('personInfo', [PersonInfo::class], $personInfo, false);
        $this->setProperty('contactInfo', [ContactInfo::class], $contactInfo, false);
        $this->setProperty('home', [Location::class], $home, false);
        $this->setProperty('contacts', [OrgArray::class], $contacts);
        $this->setProperty('startDate', ['string'], $startDate, false);
        $this->setProperty('troops', [OrgArray::class], $troops);
        $this->setProperty('patrols', [OrgArray::class], $patrols);
        $this->setProperty('roleGroups', [OrgArray::class], $roleGroups);
    }
}
