<?php

/**
 * Contains MemberEntry class
 * @author Alexander Krantz
 */

namespace Scoutorg\Scoutnet;

use Scoutorg\Lib;
use Scoutorg\Builder\Bases;

/**
 * Contains fields equivalent to the data received through
 * the scoutnet api.
 * @property-read Value $member_no The scoutnet id.
 * @property-read Value $first_name The first name.
 * @property-read Value $last_name The last name.
 * @property-read Value $ssno The person number.
 * @property-read Value $note A custom text with notes.
 * @property-read Value $date_of_birth The date of birth.
 * @property-read ValueAndRaw $status A status to show wether the member is active.
 * @property-read Value $created_at The creation date of the account.
 * @property-read Value $confirmed_at The confirmation date of the membership.
 * @property-read ValueAndRaw $group The scout group the person is a member in.
 * @property-read ValueAndRaw $unit The troop the person is a member in.
 * @property-read ValueAndRaw $patrol The patrol the person is a member in.
 * @property-read ValueAndRaw $unit_role The troop role.
 * @property-read ValueAndRaw $group_role A list of group roles separated by comma.
 * Values are separated by <comma space> while raw values are only separated by a comma.
 * @property-read ValueAndRaw $sex The gender of the person.
 * @property-read Value $address_co An address that possibly means something i guess.
 * @property-read Value $address_1 The primary address.
 * @property-read Value $address_2 The secondary address.
 * @property-read Value $address_3 The Thirdary address.
 * @property-read Value $postcode The postcode to one of the addresses.
 * (Probably the primary, who knows)
 * @property-read Value $town The town for the postcode.
 * @property-read Value $country The country where the person lives.
 * @property-read Value $email The primary email.
 * @property-read Value $contact_alt_email The secondary email.
 * @property-read Value $contact_mobile_phone The mobile phone number of the person.
 * @property-read Value $contact_home_phone The home phone number of the person.
 * @property-read Value $contact_mothers_name The name of the person's mother.
 * @property-read Value $contact_email_mum The email of the person's mother.
 * @property-read Value $contact_mobile_mum The mobile phone number of the person's mother.
 * @property-read Value $contact_telephone_mum The telephone number of the person's mother.
 * @property-read Value $contact_fathers_name The name of the person's father.
 * @property-read Value $contact_email_dad The email of the person's father.
 * @property-read Value $contact_mobile_dad The mobile phone number of person's father.
 * @property-read Value $contact_telephone_dad The telephone number of the person's father.
 * @property-read Value $contact_leader_interest Wether someone that is related to the person is interested
 * in becoming a leader.
 * @property-read Value $contact_annan_kontaktperson_epost The email of the person's contact person.
 * @property-read Value $contact_annan_kontaktperson_namn The name of the person's contact person.
 * @property-read Value $contact_annan_kontaktperson_telefon The phone number of the person's contact person.
 * @property-read Value $contact_work_phone The phone number to the person's workplace.
 * @property-read Value $contact_email another email.
 * @property-read Value $contact_work_email The email to the person's workplace.
 * @property-read Value $contact_guardian_email The email to the person's guardian.
 * @property-read Value $contact_guardian_phone_no The phone number to the person's guardian.
 * @property-read Value $contact_instant_messaging Unknown. May be wether instant messaging is enabled.
 * @property-read Value $contact_mobile_home Mobile phone number to the person's home.
 * @property-read Value $contact_mobile_me Mobile phone number to the person.
 * @property-read Value $contact_mobile_work Mobile phone number to the person's work.
 * @property-read Value $contact_maalsmans_e-post The email to the person's second guardian.
 * @property-read Value $contact_maalsmans_mobil The phone number to the person's second guardian.
 * @property-read Value $contact_maalsmans_namn The name of the person's second guardian.
 * @property-read Value $contact_maalsmans_telefon The phone number of the person's second guardian.
 * @property-read Value $contact_skype_user The person's skype username
 * @property-read Value $contact_telephone_home The phone number to the person's home.
 * @property-read Value $contact_telephone_work The phone number to the person's mobile phone.
 * @property-read Value $contact_telephone_me The phone number to the person.
 * @property-read ValueAndRaw $prev_term; Wether the person has payed for the previous term.
 * Raw is 'paid' if paid and 'not_due_unpaid' if not paid.
 * @property-read Value $prev_term_due_date The due date of the previous term payment.
 * @property-read ValueAndRaw $current_term; Wether the person has payed for the current term.
 * Raw is 'paid' if paid and 'not_due_unpaid' if not paid.
 * @property-read Value $current_term_due_date The due date for the current term payment.
 * @property-read Roles $roles
 */
class Member
{
    private $properties;

    /**
     * Creates a member from a json object.
     * @param object $object
     */
    public function __construct($object)
    {
        $this->properties = [];
        foreach ($object as $name => $value) {
            if ($name == 'roles') {
                $this->properties['roles'] = new Roles($value);
            } elseif (isset($value->raw_value)) {
                $this->properties[$name] = new ValueAndRaw($value);
            } else {
                $this->properties[$name] = new Value($value);
            }
        }
    }

    public function __get($name)
    {
        return isset($this->properties[$name]) ? $this->properties[$name] : null;
    }

    public function __isset($name)
    {
        return isset($this->properties[$name]);
    }

    /**
     * Gets the person info of the member.
     * @return Lib\PersonInfo
     */
    public function getPersonInfo()
    {
        return new Lib\PersonInfo(
            $this->properties['first_name']->value,
            $this->properties['last_name']->value,
            $this->properties['ssno']->value,
            $this->properties['sex']->value,
            $this->properties['date_of_birth']->value
        );
    }

    /**
     * Gets the contact info of the member.
     * @return Lib\ContactInfo
     */
    public function getContactInfo()
    {
        $phoneNumbers = [];
        if (isset($this->properties['contact_mobile_phone'])) {
            $phoneNumbers[] = $this->properties['contact_mobile_phone']->value;
        }
        if (isset($this->properties['contact_home_phone'])) {
            $phoneNumbers[] = $this->properties['contact_home_phone']->value;
        }
        $emailAddresses = [];
        if (isset($this->properties['email'])) {
            $emailAddresses[] = $this->properties['email']->value;
        }
        if (isset($this->properties['contact_alt_email'])) {
            $emailAddresses[] = $this->properties['contact_alt_email']->value;
        }
        return new Lib\ContactInfo(
            $phoneNumbers,
            $emailAddresses
        );
    }

    public function getHome()
    {
        return new Lib\Location(
            $this->properties['address_1']->value,
            $this->properties['postcode']->value,
            $this->properties['town']->value
        );
    }

    /**
     * @return Bases\ContactBase[]
     */
    public function getContacts()
    {
        $contacts = [];
        // Create contact 1
        if (isset($this->properties['contact_mothers_name'])) {
            $phoneNumbers = [];
            if (isset($this->properties['contact_mobile_mum'])) {
                $phoneNumbers[] = $this->properties['contact_mobile_mum']->value;
            }
            if (isset($this->properties['contact_telephone_mum'])) {
                $phoneNumbers[] = $this->properties['contact_telephone_mum']->value;
            }
            $emails = [];
            if (isset($this->properties['contact_email_mum'])) {
                $emails[] = $this->properties['contact_email_mum']->value;
            }
            $contacts["{$this->properties['member_no']->value}-1"] = new Bases\ContactBase(
                $this->properties['contact_mothers_name']->value,
                new Lib\ContactInfo($phoneNumbers, $emails)
            );
        }
        // Create contact 2
        if (isset($this->properties['contact_fathers_name'])) {
            $phoneNumbers = [];
            if (isset($this->properties['contact_mobile_dad'])) {
                $phoneNumbers[] = $this->properties['contact_mobile_dad']->value;
            }
            if (isset($this->properties['contact_telephone_dad'])) {
                $phoneNumbers[] = $this->properties['contact_telephone_dad']->value;
            }
            $emails = [];
            if (isset($this->properties['contact_email_dad'])) {
                $emails[] = $this->properties['contact_email_dad']->value;
            }
            $contacts["{$this->properties['member_no']->value}-2"] = new Bases\ContactBase(
                $this->properties['contact_fathers_name']->value,
                new Lib\ContactInfo($phoneNumbers, $emails)
            );
        }
        return $contacts;
    }

    public function getTroops()
    {
        $troops = $this->properties['roles']->getTroopRoles();
        if (isset($this->properties['unit'])) {
            $troop = $this->properties['unit'];
            if (!isset($troops[$troop->raw_value])){
                $troops[$troop->raw_value] = [];
            }
        }
        return $troops;
    }

    public function getPatrols()
    {
        $patrols = $this->properties['roles']->getPatrolRoles();
        if (isset($this->properties['patrol'])){
            $patrol = $this->properties['patrol'];
            if (!isset($patrols[$patrol->raw_value])){
                $patrols[$patrol->raw_value] = [];
            }
        }
        return $patrols;
    }

    public function getGroupRoles()
    {
        return $this->properties['roles']->groupRoles;
    }
}
