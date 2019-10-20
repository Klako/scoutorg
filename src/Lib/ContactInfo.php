<?php

/**
 * Contains ContactInfo class
 * @author Alexander Krantz
 */

namespace Scoutorg\Lib;

/**
 * Contains contact info for a member or guardian.
 * @property-read string[] $phoneNumbers
 * @property-read string[] $emails
 */
class ContactInfo extends ReadOnlyObject
{
    /**
     * Creates contact info.
     * @internal
     * @param string[] $phoneNumbers A list of phone numbers.
     * @param string[] $emails A list of email addresses.
     */
    public function __construct($phoneNumbers, $emails)
    {
        parent::__construct();
        $this->setProperty('phoneNumbers', ['array'], $phoneNumbers);
        $this->setProperty('emails', ['array'], $emails);
    }
}
