<?php

namespace Scouterna\Scoutorg\Model;

/**
 * A generic organizational object.
 * @property-read string $source
 * @property-read int|string $id
 */
class OrgObject extends ReadOnlyObject
{
    protected function __construct(string $source, $id)
    {
        parent::__construct();
        $this->setProperty('source', $source);
        $this->setProperty('id', $id, ['integer', 'string']);
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
