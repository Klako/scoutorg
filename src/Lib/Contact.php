<?php

/**
 * Contains Contact class
 * @author Alexander Krantz
 */

namespace Scouterna\Scoutorg\Lib;

/**
 * Contains a contact or guardian of a member.
 * @property-read string $name
 * @property-read ContactInfo $contactInfo
 */
class Contact extends OrgObject
{
    /**
     * Creates a new contact.
     * @internal
     * @param string $source
     * @param int|string $id
     * @param string $name
     * @param ContactInfo $contactInfo
     */
    public function __construct(string $source, $id, string $name, ContactInfo $contactInfo)
    {
        parent::__construct($source, $id);
        $this->setProperty('name', $name);
        $this->setProperty('contactInfo', $contactInfo);
    }
}
