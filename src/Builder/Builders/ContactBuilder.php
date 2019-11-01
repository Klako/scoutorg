<?php

namespace Scoutorg\Builder\Builders;

use Scoutorg\Lib;
use Scoutorg\Builder\Configs;

class ContactBuilder extends ObjectBuilder
{
    public function __construct($config, $scoutorg)
    {
        parent::__construct($config, $scoutorg);
    }
    public function build($source, $id)
    {
        $builder = $this->config['builders'][$source];
        /** @var Configs\ContactBase $base */
        $base = $builder($source, $id, 'base');

        return new Lib\Contact(
            $source,
            $id,
            $base->name,
            $base->contactInfo
        );
    }
}