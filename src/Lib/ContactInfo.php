<?php

/**
 * Contains ContactInfo class
 * @author Alexander Krantz
 */

namespace Scoutorg\Lib;

/**
 * Contains contact info for a member or guardian.
 * @property-read OrgArray<int,string> $phoneNumbers
 * @property-read OrgArray<int,string> $emailAddresses
 */
class ContactInfo extends OrgObject
{
    /**
     * Creates contact info.
     * @internal
     * @param int $id
     * @param OrgArray<mixed,string> $phoneNumbers A list of phone numbers.
     * @param OrgArray<mixed,string> $emailAddresses A list of email addresses.
     */
    public function __construct(IObjectMutator $mutator, $id, $phoneNumbers, $emailAddresses)
    {
        parent::__construct($mutator, $id);
        $this->setProperty('phoneNumbers', [OrgArray::class], $phoneNumbers, false);
        $this->setProperty('emailAddresses', [OrgArray::class], $emailAddresses, false);
    }
}
