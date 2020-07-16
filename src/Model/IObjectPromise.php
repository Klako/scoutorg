<?php

namespace Scouterna\Scoutorg\Model;

interface IObjectPromise
{
    public function getObject() : ?OrgObject;
}
