<?php

/**
 * Contains Contact class
 * @author Alexander Krantz
 */

namespace Scoutorg\Lib;

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
    public function __construct($source, $id, $name, $contactInfo)
    {
        parent::_construct($source, $id);
        $this->setProperty('name', ['string'], $name);
        $this->setProperty('contactInfo', [ContactInfo::class], $contactInfo);
    }
}
