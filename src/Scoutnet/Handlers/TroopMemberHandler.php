<?php

namespace Scouterna\Scoutorg\Scoutnet\Handlers;

class TroopMemberHandler extends Handler
{ 
    public function getBasePart($id)
    {
        $this->factory->buildMemberListData();

        return $this->factory->troopMembers->getBase($id);
    }

    public function getLinkPart($id, $method)
    {
        $this->factory->buildMemberListData();

        return $this->factory->troopMembers->getLink($id, $method);
    }

    public function getLinkParts($id, $method)
    {
        $this->factory->buildMemberListData();

        return $this->factory->troopMembers->getLink($id, $method);
    }
}
