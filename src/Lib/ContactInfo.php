<?php

/**
 * Contains ContactInfo class
 * @author Alexander Krantz
 */

namespace Scouterna\Scoutorg\Lib;

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
    public function __construct(array $phoneNumbers, array $emails)
    {
        parent::__construct();
        $this->setProperty('phoneNumbers', $phoneNumbers);
        $this->setProperty('emails', $emails);
    }
}
