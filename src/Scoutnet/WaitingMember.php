<?php

/**
 * Contains WaitingMemberEntry class
 * @author Alexander Krantz
 */

namespace Scoutorg\Scoutnet;

use Scoutorg\Lib;

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
     * @param JsonReader $jsonReader
     */
    public function __construct($jsonReader)
    {
        $this->properties = [];
        while ($jsonReader->read()) {
            $this->createValue($jsonReader->name(), $jsonReader);
        }
    }

    private function createValue($name, $jsonReader)
    {
        $object = $jsonReader->value();
        if (isset($object['raw_value'])) {
            $this->properties[$name] = new ValueAndRaw($object);
        } else {
            $this->properties[$name] = new Value($object);
        }
    }

    public function __get($name)
    {
        return isset($this->properties[$name]) ? $this->properties[$name] : null;
    }

    /**
     * Gets the person info of the waiting member as a new instance.
     * @return Lib\PersonInfo
     */
    public function getPersonInfo()
    {
        $personInfo = new Lib\PersonInfo(
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
     * @return Lib\ContactInfo
     */
    public function getContactInfo()
    {
        $phoneNumbers = [];
        $emailAddresses = [];
        if (isset($this->properties['email'])) {
            $emailAddresses[] = $this->properties['email']->value;
        }
        return new Lib\ContactInfo($phoneNumbers, $emailAddresses);
    }

    /**
     * Gets the living address and postal info of the waiting
     * member as a new instance.
     * @return Lib\Location
     */
    public function getHome()
    {
        return new Lib\Location(
            $this->properties['address_1']->value,
            $this->properties['postcode']->value,
            $this->properties['town']->value
        );
    }

    /**
     * Gets the list of contacts of the waiting member
     * as new instances.
     * @return Lib\Contact[]
     */
    public function getContacts()
    {
        $contacts = [];
        // Create contact 1
        if (isset($this->properties['contact_mothers_name'])) {
            $phoneNumbers = [
                $this->properties['contact_mobile_mum']->value,
            ];
            $emails = [
                $this->properties['contact_email_mum']->value,
            ];
            $contactInfo = new Lib\ContactInfo($phoneNumbers, $emails);
            $contacts["{$this->properties['member_no']->value}-1"] = [
                'name' => $this->properties['contact_mothers_name']->value,
                'contactinfo' => $contactInfo
            ];
        }
        // Create contact 2
        if (isset($this->properties['contact_fathers_name'])) {
            $phoneNumbers = [
                $this->properties['contact_mobile_dad']->value,
            ];
            $emails = [
                $this->properties['contact_email_dad']->value,
            ];
            $contactInfo = new Lib\ContactInfo($phoneNumbers, $emails);
            $contacts["{$this->properties['member_no']->value}-2"] = [
                'name' => $this->properties['contact_fathers_name']->value,
                'contactinfo' => $contactInfo
            ];
        }
        return $contacts;
    }
}
