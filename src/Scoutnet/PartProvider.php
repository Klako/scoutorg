<?php

namespace Scoutorg\Scoutnet;

use Scoutorg\Lib;
use Scoutorg\Builder\Bases;
use Scoutorg\Builder\IPartProvider;

class PartProvider implements IPartProvider
{
    private $factory;

    /** @var Handlers\Handler[] */
    private $handlers;

    /**
     * Creates a new scoutorg factory.
     * @param ScoutnetController $controller
     */
    public function __construct(ScoutnetController $controller)
    {
        $this->factory = new PartFactory($controller);
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

    public function getBasePart($id, string $type): \Scoutorg\Builder\Bases\ObjectBase
    {
        if (!isset($this->handlers[$type])) {
            return null;
        }

        return $this->handlers[$type]->getBasePart($id);
    }

    public function getLinkPart(\Scoutorg\Builder\Uid $uid, string $type, string $name): ?\Scoutorg\Builder\Uid
    {
        if (!isset($this->handlers[$type])) {
            return null;
        }
        if ($uid->getSource() !== 'scoutnet') {
            return null;
        }
        return $this->handlers[$type]->getLinkPart($uid->getId(), $name) ?: null;
    }

    public function getLinkParts(\Scoutorg\Builder\Uid $uid, string $type, string $name): array
    {
        if (!isset($this->handlers[$type])) {
            return [];
        }
        if ($uid->getSource() !== 'scoutnet') {
            return [];
        }

        return $this->getLinkParts($uid->getId(), $type, $name) ?: [];
    }
}
