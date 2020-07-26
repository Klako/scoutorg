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

    protected function setArray(string $name, IArrayPromise $value)
    {
        $this->setProperty($name, $value);
    }

    protected function setEdgeArray(string $name, IEdgeArrayPromise $value){
        $this->setProperty($name, $value);
    }

    protected function setObject(string $name, IObjectPromise $value)
    {
        $this->setProperty($name, $value);
    }
}
