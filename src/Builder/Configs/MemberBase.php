<?php

namespace Scoutorg\Builder\Configs;

use Scoutorg\Lib;

/**
 * A configuration for building a member.
 * @property-read Lib\PersonInfo $personInfo
 * @property-read Lib\ContactInfo $contactInfo
 * @property-read Lib\Location $home
 * @property-read string $startdate
 */
class MemberBase extends Lib\ReadOnlyObject
{
    public function __construct(
        $personInfo,
        $contactInfo,
        $home,
        $startdate
    ) { 
        parent::__construct();
        $this->setProperty('personInfo', [Lib\PersonInfo::class], $personInfo);
        $this->setProperty('contactInfo', [Lib\ContactInfo::class], $contactInfo);
        $this->setProperty('home', [Lib\Location::class], $home);
        $this->setProperty('startdate', ['string'], $startdate);
    }
}
