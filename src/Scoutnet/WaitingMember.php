<?php

/**
 * Contains WaitingMemberEntry class
 * @author Alexander Krantz
 */

namespace Scouterna\Scoutorg\Scoutnet;

use Scouterna\Scoutorg\Model;
use Scouterna\Scoutorg\Builder\Bases;

/**
 * Contains fields equivalent to an
 * entry in the scoutnet waiting list.
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
 * @property-read Value $waiting_since The date the member started waiting for a place.
 * @property-read ValueAndRaw $sex The gender of the person.
 * @property-read Value $address_1 The primary address.
 * @property-read Value $postcode The postcode to one of the addresses.
 * (Probably the primary, who knows)
 * @property-read Value $town The town for the postcode.
 * @property-read Value $country The country where the person lives.
 * @property-read Value $email The primary email.
 * @property-read Value $contact_mothers_name The name of the person's mother.
 * @property-read Value $contact_email_mum The email of the person's mother.
 * @property-read Value $contact_mobile_mum The mobile phone number of the person's mother.
 * @property-read Value $contact_telephone_mum The telephone number of the person's mother.
 * @property-read Value $contact_fathers_name The name of the person's father.
 * @property-read Value $contact_email_dad The email of the person's father.
 * @property-read Value $contact_mobile_dad The mobile phone number of person's father.
 * @property-read Value $contact_telephone_dad The telephone number of the person's father.
 * @property-read Value $contact_leader_interest Wether the person's parent or relative has a leader interest.
 * @property-read Value $contact_instant_messaging Unknown. May be wether instant messaging is enabled.
 */
class WaitingMember
{
    private $properties;

    /**
     * Creates a member object from a json reader
     * @param object $object
     */
    public function __construct($object)
    {
        $this->properties = [];
        foreach ($object as $name => $value) {
            if (isset($value->raw_value)) {
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

    public function __isset($name){
        return isset($this->properties[$name]);
    }

    /**
     * Gets the person info of the waiting member as a new instance.
     * @return Model\PersonInfo
     */
    public function getPersonInfo()
    {
        $personInfo = new Model\PersonInfo(
            $this->properties['first_name']->value,
            $this->properties['last_name']->value,
            $this->properties['ssno']->value,
            $this->properties['sex']->value,
            $this->properties['date_of_birth']->value
        );
        return $personInfo;
    }

    /**
     * Gets the contact info of the waiting member as a new instance.
     * @return Model\ContactInfo
     */
    public function getContactInfo()
    {
        $phoneNumbers = [];
        $emailAddresses = [];
        if (isset($this->properties['email'])) {
            $emailAddresses[] = $this->properties['email']->value;
        }
        return new Model\ContactInfo($phoneNumbers, $emailAddresses);
    }

    /**
     * Gets the living address and postal info of the waiting
     * member as a new instance.
     * @return Model\Location
     */
    public function getHome()
    {
        return new Model\Location(
            $this->properties['address_1']->value,
            $this->properties['postcode']->value,
            $this->properties['town']->value
        );
    }

    /**
     * Gets the list of contacts of the waiting member
     * as new instances.
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
            $emails = [];
            if (isset($this->properties['contact_email_mum'])) {
                $emails[] = $this->properties['contact_email_mum']->value;
            }
            $contacts["{$this->properties['member_no']->value}-1"] = new Bases\ContactBase(
                $this->properties['contact_mothers_name']->value,
                new Model\ContactInfo($phoneNumbers, $emails)
            );
        }
        // Create contact 2
        if (isset($this->properties['contact_fathers_name'])) {
            $phoneNumbers = [];
            if (isset($this->properties['contact_mobile_dad'])) {
                $phoneNumbers[] = $this->properties['contact_mobile_dad']->value;
            }
            $emails = [];
            if (isset($this->properties['contact_email_dad'])) {
                $emails[] = $this->properties['contact_email_dad']->value;
            }
            $contacts["{$this->properties['member_no']->value}-2"] = new Bases\ContactBase(
                $this->properties['contact_fathers_name']->value,
                new Model\ContactInfo($phoneNumbers, $emails)
            );
        }
        return $contacts;
    }
}
