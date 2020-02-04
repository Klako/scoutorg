<?php

namespace Scoutorg\Scoutnet\Handlers;

class GroupMemberHandler extends Handler
{
    public function getBasePart($id)
    {
        $this->factory->buildMemberListData();

        return $this->factory->groupMembers->getBase($id);
    }

    public function getLinkPart($id, $method)
    {
        $this->factory->buildMemberListData();

        return $this->factory->groupMembers->getLink($id, $method);
    }

    public function getLinkParts($id, $method)
    {
        $this->factory->buildMemberListData();

        return $this->factory->groupMembers->getLink($id, $method);
    }
}
