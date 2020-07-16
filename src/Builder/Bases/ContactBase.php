<?php

namespace Scouterna\Scoutorg\Builder\Bases;

use Scouterna\Scoutorg\Model;
use Scouterna\Scoutorg\Model\Arrays\ContactArray;

/**
 * A configuration for building a contact.
 */
class ContactBase extends ObjectBase
{
    public const ARRAY_TYPE = ContactArray::class;

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