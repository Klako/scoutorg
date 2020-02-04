<?php

namespace Scoutorg\Scoutnet\Handlers;

class GroupRoleHandler extends Handler
{
    public function getBasePart($id)
    {
        $this->factory->buildMemberListData();

        return $this->factory->groupRoles->getBase($id);
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
