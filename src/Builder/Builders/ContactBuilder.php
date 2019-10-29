<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;
use Scoutorg\Builder\Configs;

class ContactBuilder extends ObjectBuilder
{
    public function __construct($config, $source, $id, $scoutorg)
    {
        parent::__construct($config, $source, $id, $scoutorg);
    }
    public function build()
    {
        $builder = $this->builder;
        /** @var Configs\ContactBase $base */
        $base = $builder($this->source, $this->id, 'base');

        return new Lib\Contact(
            $this->source,
            $this->id,
            $base->name,
            $base->contactInfo
        );
    }
}