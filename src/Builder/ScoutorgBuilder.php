<?php

namespace Scouterna\Scoutorg\Builder;

use Scouterna\Scoutorg\Builder\Tables;

/**
 * @property-read Tables\ScoutGroupTable $scoutGroups
 * @property-read Tables\TroopTable $troops
 * @property-read Tables\BranchTable $branches
 * @property-read Tables\PatrolTable $patrols
 * @property-read Tables\MemberTable $members
 * @property-read Tables\CustomListTable $customLists
 * @property-read Tables\ContactTable $contacts
 * @property-read Tables\WaitingMemberTable $waitingMembers
 * @property-read Tables\TroopMemberTable $troopMembers
 * @property-read Tables\PatrolMemberTable $patrolMembers
 * @property-read Tables\TroopRoleTable $troopRoles
 * @property-read Tables\PatrolRoleTable $patrolRoles
 * @property-read Tables\GroupRoleTable $groupRoles
 * @property-read Tables\GroupMemberTable $groupMembers
 */
class ScoutorgBuilder
{
    /** @var array<string,Tables\BuilderTable> */
    private $tables;

    /** @var array<string,Tables\BuilderTable> */
    private $baseIndexedTables;

    /**
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->tables = [];
        $this->setTable('scoutGroups', Bases\ScoutGroupBase::class, new Tables\ScoutGroupTable($config, $this));
        $this->setTable('troops', Bases\TroopBase::class, new Tables\TroopTable($config, $this));
        $this->setTable('branches', Bases\BranchBase::class, new Tables\BranchTable($config, $this));
        $this->setTable('patrols', Bases\PatrolBase::class, new Tables\PatrolTable($config, $this));
        $this->setTable('members', Bases\MemberBase::class, new Tables\MemberTable($config, $this));
        $this->setTable('customLists', Bases\CustomListBase::class, new Tables\CustomListTable($config, $this));
        $this->setTable('contacts', Bases\ContactBase::class, new Tables\ContactTable($config, $this));
        $this->setTable('groupWaiters', Bases\GroupWaiterBase::class, new Tables\GroupWaiterTable($config, $this));
        $this->setTable('troopMembers', Bases\TroopMemberBase::class, new Tables\TroopMemberTable($config, $this));
        $this->setTable('patrolMembers', Bases\PatrolMemberBase::class, new Tables\PatrolMemberTable($config, $this));
        $this->setTable('troopRoles', Bases\TroopRoleBase::class, new Tables\TroopRoleTable($config, $this));
        $this->setTable('patrolRoles', Bases\PatrolRoleBase::class, new Tables\PatrolRoleTable($config, $this));
        $this->setTable('groupRoles', Bases\GroupRoleBase::class, new Tables\GroupRoleTable($config, $this));
        $this->setTable('groupMembers', Bases\GroupMemberBase::class, new Tables\GroupMemberTable($config, $this));
    }

    private function setTable($name, $baseClass, $table)
    {
        $this->tables[$name] = $table;
        $this->baseIndexedTables[$baseClass] = $table;
    }

    /**
     * Gets the table corresponding to the specified
     * fully qualified base class name.
     * @param string $baseClass 
     * @return Tables\BuilderTable|null 
     */
    public function getTable(string $baseClass)
    {
        return $this->baseIndexedTables[$baseClass] ?? null;
    }

    public function __get($name)
    {
        if (isset($this->tables[$name])) {
            return $this->tables[$name];
        } else {
            throw new \Exception("Property $name is not defined");
        }
    }
}
