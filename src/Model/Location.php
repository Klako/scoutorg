<?php

/**
 * Contains Location class
 * @author Alexander Krantz
 */

namespace Scouterna\Scoutorg\Model;

/**
 * Contains address and postal info for a location.
 * @property-read string $address
 * @property-read string $postCode
 * @property-read string $postTowm
 */
class Location extends ReadOnlyObject
{
    /**
     * Creates a new location.
     * @internal
     * @param string $address The living address.
     * @param string $postCode The swedish post code of the address.
     * @param string $postTown The town of the post code.
     */
    public function __construct(string $address, string $postCode, string $postTown)
    {
        parent::__construct();
        $this->setProperty('address', $address);
        $this->setProperty('postCode', $postCode);
        $this->setProperty('postTown', $postTown);
    }
}
