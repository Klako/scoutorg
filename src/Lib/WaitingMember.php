<?php

/**
 * Contains WaitingMember class
 * @author Alexander Krantz
 */

namespace Scoutorg\Lib;

/**
 * A member that's waiting for group placement.
 * @property-read PersonInfo $personInfo
 * @property-read ContactInfo $contactInfo
 * @property-read Location $home
 * @property-read OrgArray<int,Contact> $contacts
 * @property-read string $note
 * @property-read bool $leaderInterest
 */
class WaitingMember extends OrgObject
{
    /**
     * Creates a new waiting member
     * @internal
     * @param int $id
     * @param PersonInfo|IPropertyProvider $personInfo
     * @param ContactInfo|IPropertyProvider $contactInfo
     * @param Location|IPropertyProvider $home
     * @param Contact[]|IPropertyProvider $contacts
     * @param string|IPropertyProvider $waitingStartDate
     * @param string|IPropertyProvider $note
     * @param bool|IPropertyProvider $leaderInterest
     */
    public function __construct(
        IObjectMutator $mutator,
        $id,
        $personInfo,
        $contactInfo,
        $home,
        $contacts,
        $waitingStartDate,
        $note,
        $leaderInterest
    ) {
        parent::__construct($mutator, $id);
        $this->setProperty('personInfo', [PersonInfo::class], $personInfo);
        $this->setProperty('contactInfo', [ContactInfo::class], $contactInfo);
        $this->setProperty('home', [Location::class], $home);
        $this->setProperty('contacts', [OrgArray::class], $contacts);
        $this->setProperty('waitingStartdate', ['string'], $waitingStartDate);
        $this->setProperty('note', ['string'], $note);
        $this->setProperty('leaderInterest', ['bool'], $leaderInterest);
    }
}
