<?php

namespace Scoutorg\Scoutnet\Handlers;

class CustomListHandler extends Handler
{
    public function getBasePart($id)
    {
        $this->factory->buildCustomListData();

        if (!$this->factory->customLists->hasBase($id)) {
            return null;
        }

        return $this->factory->customLists->getBase($id);
    }

    public function getLinkPart($id, $method)
    {
        return null;
    }

    public function getLinkParts($id, $method)
    {
        switch ($method) {
            case 'members':
                $this->factory->buildCustomListMemberData($id);
                break;
            case 'sublists':
                $this->factory->buildCustomListData();
                break;
            default:
                return [];
        }

        return $this->factory->customLists->getLink($id, 'members');
    }
}
