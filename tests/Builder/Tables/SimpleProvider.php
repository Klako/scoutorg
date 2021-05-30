<?php

namespace Scouterna\Scoutorg\Tests\Builder\Tables;

use Scouterna\Scoutorg\Builder\Bases\ObjectBase;
use Scouterna\Scoutorg\Builder\IPartProvider;
use Scouterna\Scoutorg\Model\Uid;
use Scouterna\Scoutorg\Builder\Link;

class SimpleProvider implements IPartProvider
{
    private $parts;

    public function setBasePart(string $type, string $id, $basePart)
    {
        $this->parts[$type][$id]['base'] = $basePart;
    }

    public function setLinkParts(string $type, string $id, string $name, array $linkParts)
    {
        $this->parts[$type][$id]['links'][$name] = $linkParts;
    }

    public function setLinkPart(string $type, string $id, string $name, Link $linkPart)
    {
        $this->parts[$type][$id]['links'][$name] = $linkPart;
    }

    public function getBasePart($id, string $type): ?ObjectBase
    {
        return $this->parts[$type][$id]['base'];
    }

    public function getLinkParts(Uid $uid, string $type, string $name): array
    {
        return $this->parts[$type][$uid->id]['links'][$name] ?? [];
    }

    public function getLinkPart(Uid $uid, string $type, string $name): ?Link
    {
        return $this->parts[$type][$uid->id]['links'][$name] ?? null;
    }
}
