<?php

namespace Scouterna\Scoutorg\Builder\Bases;

use Scouterna\Scoutorg\Lib;
use Scouterna\Scoutorg\Lib\Arrays\MemberArray;

/**
 * A configuration for building a member.
 */
class MemberBase extends ObjectBase
{
    public const ARRAY_TYPE = MemberArray::class;

    private $personInfo;
    private $contactInfo;
    private $home;
    private $note;
    private $leaderInterest;

    public function __construct(
        Lib\PersonInfo $personInfo,
        Lib\ContactInfo $contactInfo,
        Lib\Location $home,
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
