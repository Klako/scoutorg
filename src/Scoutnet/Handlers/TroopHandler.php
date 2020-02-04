<?php

namespace Scoutorg\Scoutnet\Handlers;

class TroopHandler extends Handler
{ 
    public function getBasePart($id)
    {
        $this->factory->buildMemberListData();

        return $this->factory->troops->getBase($id);
    }

    public function getLinkPart($id, $method)
    {
        $this->factory->buildMemberListData();

        return $this->factory->troops->getLink($id, $method);
    }

    public function getLinkParts($id, $method)
    {
        $this->factory->buildMemberListData();

        return $this->factory->troops->getLink($id, $method);
    }
}
