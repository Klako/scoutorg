<?php

namespace Scouterna\Scoutorg\Builder\Bases;

use Scouterna\Scoutorg\Model;

/**
 * A configuration for building a contact.
 */
class ContactBase extends ObjectBase
{
    private $name;
    private $contactInfo;

    public function __construct(string $name, Model\ContactInfo $contactInfo)
    {
        $this->name = $name;
        $this->contactInfo = $contactInfo;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the value of contactInfo
     */ 
    public function getContactInfo()
    {
        return $this->contactInfo;
    }
}