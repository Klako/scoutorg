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
 * @property-read ContactArray<int,Contact> $contacts
 * @property-read string $note
 * @property-read bool $leaderInterest
 */
class WaitingMember extends OrgObject
{
    /**
     * Creates a new waiting member
     * @internal
     * @param string $source
     * @param int|string $id
     * @param PersonInfo $personInfo
     * @param ContactInfo $contactInfo
     * @param Location $home
     * @param Contact[] $contacts
     * @param string $waitingStartDate
     * @param string $note
     * @param bool $leaderInterest
     */
    public function __construct(
        $source,
        $id,
        $personInfo,
        $contactInfo,
        $home,
        $contacts,
        $waitingStartDate,
        $note,
        $leaderInterest
    ) {
        parent::__construct($source, $id);
        $this->setProperty('personInfo', [PersonInfo::class], $personInfo);
        $this->setProperty('contactInfo', [ContactInfo::class], $contactInfo);
        $this->setProperty('home', [Location::class], $home);
        $this->setProperty('contacts', [OrgArray::class], $contacts);
        $this->setProperty('waitingStartdate', ['string'], $waitingStartDate);
        $this->setProperty('note', ['string'], $note);
        $this->setProperty('leaderInterest', ['boolean'], $leaderInterest);
    }
}
