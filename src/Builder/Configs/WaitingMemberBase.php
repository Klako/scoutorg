<?php

namespace Scoutorg\Builder\Configs;

use Scoutorg\Lib;

/**
 * A configuration for building a waiting member.
 * @property-read Lib\PersonInfo $personInfo
 * @property-read Lib\ContactInfo $contactInfo
 * @property-read Lib\Location $home
 * @property-read string $waitingStartdate
 * @property-read string $note
 * @property-read bool $leaderInterest
 */
class WaitingMemberBase extends Lib\ReadOnlyObject
{
    public function __construct($personInfo, $contactInfo, $home, $waitingStartdate, $note, $leaderInterest)
    {
        parent::__construct();
        $this->setProperty('personInfo', [Lib\PersonInfo::class], $personInfo);
        $this->setProperty('contactInfo', [Lib\ContactInfo::class], $contactInfo);
        $this->setProperty('home', [Lib\Location::class], $home);
        $this->setProperty('waitingStartdate', ['string'], $waitingStartdate);
        $this->setProperty('note', ['string'], $note);
        $this->setProperty('leaderInterest', ['boolean'], $leaderInterest);
    }
}