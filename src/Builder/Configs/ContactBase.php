<?php

namespace Scoutorg\Builder\Configs;

use Scoutorg\Lib;

/**
 * A configuration for building a contact.
 * @property-read string $name
 * @property-read Lib\ContactInfo $contactInfo
 */
class ContactBase extends Lib\ReadOnlyObject
{
    public function __construct($name, $contactInfo)
    {
        parent::__construct();
        $this->setProperty('name', ['string'], $name);
        $this->setProperty('contactInfo', [Lib\ContactInfo::class], $contactInfo);
    }
}