<?php

namespace Scouterna\Scoutorg\Scoutnet\Handlers;

class ContactHandler extends Handler
{
    public function getBasePart($id)
    {
        $this->factory->buildMemberListData();

        if ($this->factory->contacts->hasBase($id)) {
            return $this->factory->contacts->getBase($id);
        }
        
        $this->factory->buildWaitingListData();

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
