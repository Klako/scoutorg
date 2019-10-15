<?php

/**
 * Contains Contact class
 * @author Alexander Krantz
 */

namespace Scoutorg\Lib;

/**
 * Contains a contact or guardian of a member.
 * @property-read int $id
 * @property-read string $name
 * @property-read ContactInfo $contactInfo
 */
class Contact extends OrgObject
{
    /**
     * Creates a new contact.
     * @internal
     * @param int $id
     * @param string $name
     * @param ContactInfo $contactInfo
     */
    public function __construct($id, $name, $contactInfo)
    {
        $this->setProperty('id', ['int'], $id, false);
        $this->setProperty('name', ['string'], $name, false);
        $this->setProperty('contactInfo', [ContactInfo::class], $contactInfo, false);
    }
}
