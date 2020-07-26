<?php

namespace Scouterna\Scoutorg\Builder\Bases;

use Scouterna\Scoutorg\Model;

/**
 * A configuration for building a member.
 */
class MemberBase extends ObjectBase
{
    private $personInfo;
    private $contactInfo;
    private $home;
    private $note;
    private $leaderInterest;

    public function __construct(
        Model\PersonInfo $personInfo,
        Model\ContactInfo $contactInfo,
        Model\Location $home,
        string $note,
        bool $leaderInterest
    ) {
        $this->personInfo = $personInfo;
        $this->contactInfo = $contactInfo;
        $this->home = $home;
        $this->note = $note;
        $this->leaderInterest = $leaderInterest;
    }

    public function getPersonInfo()
    {
        return $this->personInfo;
    }

    public function getContactInfo()
    {
        return $this->contactInfo;
    }

    public function getHome()
    {
        return $this->home;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function getLeaderInterest()
    {
        return $this->leaderInterest;
    }
}
