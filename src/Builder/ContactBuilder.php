<?php

namespace Scoutorg\Builder;

use Scoutorg\Lib;

class ContactBuilder extends ObjectBuilder
{
    public function __construct($config, $source, $id, $scoutorg)
    {
        parent::__construct($config, $source, $id, $scoutorg);
    }
    public function build()
    {
        $builder = $this->builder;
        $contact = $builder($this->id, 'base');

        return new Lib\Contact(
            $this->source,
            $this->id,
            $contact['name'],
            $contact['contactinfo']
        );
    }
}