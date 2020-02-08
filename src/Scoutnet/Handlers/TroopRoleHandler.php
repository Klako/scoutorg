<?php

namespace Scouterna\Scoutorg\Scoutnet\Handlers;

class TroopRoleHandler extends Handler
{
    public function getBasePart($id)
    {
        $this->factory->buildMemberListData();

        return $this->factory->contacts->getBase($id);
    }

    public function getLinkPart($id, $method)
    {
        return null;
    }

    public function getLinkParts($id, $method)
    {
        return [];
    }
}
