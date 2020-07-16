<?php

namespace Scouterna\Scoutorg\Model;

/**
 * A generic organizational object.
 * @property-read Uid $uid
 */
abstract class OrgObject extends ReadOnlyObject
{
    protected function __construct(Uid $uid)
    {
        parent::__construct();
        $this->setProperty('uid', $uid);
    }

    protected function setArray(string $name, $value, string $arrayType)
    {
        $this->setProperty($name, $value, [$arrayType, IArrayPromise::class]);
    }

    protected function setObject(string $name, $value, string $objectType)
    {
        $this->setProperty($name, $value, [$objectType, IObjectPromise::class]);
    }
}
