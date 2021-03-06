<?php

namespace Scouterna\Scoutorg\Scoutnet;

use Scouterna\Scoutorg\Model;
use Scouterna\Scoutorg\Builder\Bases;
use Scouterna\Scoutorg\Builder\IPartProvider;
use Scouterna\Scoutorg\Builder\Link;

class PartProvider implements IPartProvider
{
    private $factory;
    private $source;

    /** @var Handlers\Handler[] */
    private $handlers;

    /**
     * Creates a new Scouterna\Scoutorg factory.
     * @param ScoutnetController $controller
     */
    public function __construct(ScoutnetController $controller, $sourceName)
    {
        $this->factory = new PartFactory($controller, $sourceName);
        $this->source = $sourceName;
        $this->handlers = [];
        $this->setHandler(Bases\ScoutGroupBase::class, Handlers\ScoutGroupHandler::class);
        $this->setHandler(Bases\MemberBase::class, Handlers\MemberHandler::class);
        $this->setHandler(Bases\TroopBase::class, Handlers\TroopHandler::class);
        $this->setHandler(Bases\PatrolBase::class, Handlers\PatrolHandler::class);
        $this->setHandler(Bases\GroupRoleBase::class, Handlers\GroupRoleHandler::class);
        $this->setHandler(Bases\CustomListBase::class, Handlers\CustomListHandler::class);
        $this->setHandler(Bases\GroupWaiterBase::class, Handlers\GroupWaiterHandler::class);
        $this->setHandler(Bases\TroopMemberBase::class, Handlers\TroopMemberHandler::class);
        $this->setHandler(Bases\TroopRoleBase::class, Handlers\TroopRoleHandler::class);
        $this->setHandler(Bases\PatrolRoleBase::class, Handlers\PatrolRoleHandler::class);
        $this->setHandler(Bases\PatrolMemberBase::class, Handlers\PatrolMemberHandler::class);
        $this->setHandler(Bases\ContactBase::class, Handlers\ContactHandler::class);
        $this->setHandler(Bases\GroupMemberBase::class, Handlers\GroupMemberHandler::class);
    }

    private function setHandler($type, $handler)
    {
        $this->handlers[$type] = new $handler($this->factory);
    }

    public function getBasePart($id, string $type): ?Bases\ObjectBase
    {
        if (!isset($this->handlers[$type])) {
            return null;
        }

        return $this->handlers[$type]->getBasePart($id);
    }

    public function getLinkPart(Model\Uid $uid, string $type, string $name): ?Link
    {
        if (!isset($this->handlers[$type])) {
            return null;
        }
        if ($uid->getSource() !== $this->source) {
            return null;
        }
        return $this->handlers[$type]->getLinkPart($uid->getId(), $name) ?: null;
    }

    public function getLinkParts(Model\Uid $uid, string $type, string $name): array
    {
        if (!isset($this->handlers[$type])) {
            return [];
        }
        if ($uid->getSource() !== $this->source) {
            return [];
        }

        return $this->handlers[$type]->getLinkParts($uid->getId(), $name) ?: [];
    }
}
