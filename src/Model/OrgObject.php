<?php

namespace Scouterna\Scoutorg\Model;

/**
 * A generic organizational object.
 * @property-read Uid $uid
 */
abstract class OrgObject extends ReadOnlyObject
{
    private $metaInfos;

    protected function __construct(Uid $uid)
    {
        parent::__construct();
        $this->setProperty('uid', $uid);
        $this->metaInfos = [];
    }

    protected function setArray(string $name, IArrayPromise $value)
    {
        $this->setProperty($name, $value);
    }

    protected function setEdgeArray(string $name, IEdgeArrayPromise $value)
    {
        $this->setProperty($name, $value);
    }

    protected function setObject(string $name, IObjectPromise $value)
    {
        $this->setProperty($name, $value);
    }

    protected function setMetaInfo($propertyName, $metaInfo){
        $this->metaInfos[$propertyName] = $metaInfo;
    }

    /**
     * Gets meta info for a link to another org object.
     * @param mixed $propertyName name of the property to the other org object.
     * @return LinkMetaInfo[]
     * @throws \Exception if meta info for property does not exist.
     */
    public function getMetaInfo($propertyName){
        if (!\array_key_exists($propertyName, $this->metaInfos)) {
            throw new \Exception("Meta info for property $propertyName does not exist");
        }
        return $this->metaInfos[$propertyName];
    }

    /**
     * @internal
     * @param string $name 
     * @return mixed
     * @throws \Exception 
     * @throws \TypeError 
     */
    public function __get($name)
    {
        $value = parent::__get($name);
        if ($value instanceof IObjectPromise) {
            $link = $value->getObjectLink();
            if ($link === null) {
                $value = null;
                $metaInfos = [];
            } else {
                $value = $link->getObject();
                $metaInfos = $link->getMetaInfos();
            }
            $this->setProperty($name, $value);
            $this->setMetaInfo($name, $metaInfos);
        } elseif (
            $value instanceof IArrayPromise
            || $value instanceof IEdgeArrayPromise
        ) {
            $value = $value->getArray();
            $this->setProperty($name, $value);
        }
        return $value;
    }
}
