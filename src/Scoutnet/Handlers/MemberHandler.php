<?php

namespace Scoutorg\Scoutnet\Handlers;

class MemberHandler extends Handler
{ 
    public function getBasePart($id)
    {
        $this->factory->buildMemberListData();

        if ($this->factory->members->hasBase($id)){
            return $this->factory->members->getBase($id);
        }

        $this->factory->buildWaitingListData();

        return $this->factory->members->getBase($id);
    }

    public function getLinkPart($id, $method)
    {
        $this->factory->buildMemberListData();

        if ($this->factory->members->hasBase($id)){
            return $this->factory->members->getLink($id, $method);
        }

        $this->factory->buildWaitingListData();

        return $this->factory->members->getLink($id, $method);
    }

    public function getLinkParts($id, $method)
    {
        $this->factory->buildMemberListData();

        if ($this->factory->members->hasBase($id)){
            return $this->factory->members->getLink($id, $method);
        }

        $this->factory->buildWaitingListData();

        return $this->factory->members->getLink($id, $method);
    }
}
