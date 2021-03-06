<?php

namespace Scouterna\Scoutorg\Scoutnet\Handlers;

class PatrolMemberHandler extends Handler
{
    public function getBasePart($id)
    {
        $this->factory->buildMemberListData();

        return $this->factory->patrolMembers->getBase($id);
    }

    public function getLinkPart($id, $method)
    {
        $this->factory->buildMemberListData();

        return $this->factory->patrolMembers->getLink($id, $method);
    }

    public function getLinkParts($id, $method)
    {
        $this->factory->buildMemberListData();

        return $this->factory->patrolMembers->getLinks($id, $method);
    }
}
