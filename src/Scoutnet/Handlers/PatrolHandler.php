<?php

namespace Scouterna\Scoutorg\Scoutnet\Handlers;

class PatrolHandler extends Handler
{ 
    public function getBasePart($id)
    {
        $this->factory->buildMemberListData();

        return $this->factory->patrols->getBase($id);
    }

    public function getLinkPart($id, $method)
    {
        $this->factory->buildMemberListData();

        return $this->factory->patrols->getLink($id, $method);
    }

    public function getLinkParts($id, $method)
    {
        $this->factory->buildMemberListData();

        return $this->factory->patrols->getLinks($id, $method);
    }
}
