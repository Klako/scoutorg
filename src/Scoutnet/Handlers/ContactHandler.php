<?php

namespace Scoutorg\Scoutnet\Handlers;

class ContactHandler extends Handler
{
    public function getBasePart($id)
    {
        $this->factory->buildMemberListData();
        $this->factory->buildWaitingListData();

        if ($this->factory->contacts->hasBase($id)) {
            return null;
        }

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
