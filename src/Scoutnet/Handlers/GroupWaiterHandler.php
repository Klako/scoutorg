<?php

namespace Scouterna\Scoutorg\Scoutnet\Handlers;

class GroupWaiterHandler extends Handler
{
    public function getBasePart($id)
    {
        $this->factory->buildWaitingListData();

        return $this->factory->groupWaiters->getBase($id);
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
