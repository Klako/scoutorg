<?php

namespace Scouterna\Scoutorg\Builder\Tables;

use Scouterna\Scoutorg\Builder\Bases\ContactBase;
use Scouterna\Scoutorg\Lib\Contact;

class ContactTable extends BuilderTable
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg, ContactBase::class);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @return Contact 
     * @throws \OutOfRangeException 
     */
    public function get($source, $id)
    {
        return parent::get($source, $id);
    }

    /**
     * @param string $source 
     * @param int|string $id 
     * @param ContactBase $base 
     * @return Contact
     */
    protected function build($source, $id, $base)
    {
        return new Contact(
            $source,
            $id,
            $base->getName(),
            $base->getContactInfo()
        );
    }
}
