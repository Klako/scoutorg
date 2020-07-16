<?php

/**
 * Contains Contact class
 * @author Alexander Krantz
 */

namespace Scouterna\Scoutorg\Model;

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
     * @param Uid $uid
     * @param string $name
     * @param ContactInfo $contactInfo
     */
    public function __construct(Uid $uid, string $name, ContactInfo $contactInfo)
    {
        parent::__construct($uid);
        $this->setProperty('name', $name);
        $this->setProperty('contactInfo', $contactInfo);
    }
}
