<?php

namespace Scouterna\Scoutorg\Scoutnet\Handlers;

class PatrolRoleHandler extends Handler
{
    public function getBasePart($id)
    {
        $this->factory->buildMemberListData();

        return $this->factory->patrolRoles->getBase($id);
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
