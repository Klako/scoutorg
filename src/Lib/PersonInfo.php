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
class PersonInfo extends OrgObject
{
    /**
     * Creates a new set of person info.
     * @internal
     * @param IObjectMutator $mutator
     * @param int $id
     * @param string $firstname The person's first name.
     * @param string $lastname The person's last name.
     * @param string $ssno The person's swedish personal number.
     * @param string $gender The person's gender.
     * @param string $dob The person's date of birth
     */
    public function __construct(IObjectMutator $mutator, $id, $firstname, $lastname, $ssno, $gender, $dob)
    {
        parent::__construct($mutator, $id);
        $this->setProperty('firstname', ['string'], $firstname, false);
        $this->setProperty('lastname', ['string'], $lastname, false);
        $this->setProperty('ssno', ['string'], $ssno, false);
        $this->setProperty('gender', ['string'], $gender, false);
        $this->setProperty('dob', ['string'], $dob, false);
    }
}
