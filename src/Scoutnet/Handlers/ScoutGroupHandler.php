<?php

namespace Scoutorg\Scoutnet\Handlers;

class ScoutGroupHandler extends Handler
{ 
    public function getBasePart($id)
    {
        $this->factory->buildScoutGroupData($id);

        return $this->factory->scoutgroups->getBase($id);
    }

    public function getLinkPart($id, $method)
    {
        return null;
    }

    public function getLinkParts($id, $method)
    {
        switch ($method) {
            case 'branches':
                return [];
            case 'members':
            case 'troops':
            case 'grouproles':
                $this->factory->buildMemberListData($id);
                break;
            case 'customlists':
                $this->factory->buildCustomListData($id);
                break;
            case 'waitinglist':
                $this->factory->buildWaitingListData($id);
                break;
            default:
                return [];
        }

        return $this->factory->scoutgroups->getLink($id, $method);
    }
}
