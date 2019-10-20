<?php

/**
 * Contains PersonalInfo class
 * @author Alexander Krantz
 */

namespace Scoutorg\Lib;

/**
 * Personal info about a member.
 * @property-read string $firstname
 * @property-read string $lastname
 * @property-read string $ssno
 * @property-read string $gender
 * @property-read string $dob
 */
class PersonInfo extends ReadOnlyObject
{
    /**
     * Creates a new set of person info.
     * @internal
     * @param string $firstname The person's first name.
     * @param string $lastname The person's last name.
     * @param string $ssno The person's swedish personal number.
     * @param string $gender The person's gender.
     * @param string $dob The person's date of birth.
     */
    public function __construct($firstname, $lastname, $ssno, $gender, $dob)
    {
        parent::__construct();
        $this->setProperty('firstname', ['string'], $firstname);
        $this->setProperty('lastname', ['string'], $lastname);
        $this->setProperty('ssno', ['string'], $ssno);
        $this->setProperty('gender', ['string'], $gender);
        $this->setProperty('dob', ['string'], $dob);
    }
}
