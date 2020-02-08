<?php

/**
 * Contains PersonalInfo class
 * @author Alexander Krantz
 */

namespace Scouterna\Scoutorg\Lib;

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
    public function __construct(string $firstname, string $lastname, string $ssno, string $gender, string $dob)
    {
        parent::__construct();
        $this->setProperty('firstname', $firstname);
        $this->setProperty('lastname', $lastname);
        $this->setProperty('ssno', $ssno);
        $this->setProperty('gender', $gender);
        $this->setProperty('dob', $dob);
    }
}
