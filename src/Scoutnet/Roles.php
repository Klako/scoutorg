<?php

namespace Scoutorg\Scoutnet;

/**
 * A collection of roles in the scout group.
 */
class Roles
{
    private $groupRoles;
    private $troopRoles;
    private $patrolRoles;

    public function __construct($object)
    {
        $this->groupRoles = [];
        $this->troopRoles = [];
        $this->patrolRoles = [];
        if (isset($object->value->group)) {
            foreach ($object->value->group as $groupId => $groupRoles) {
                foreach ($groupRoles as $roleId => $role) {
                    $this->groupRoles[$groupId][$roleId] = $role->role_name;
                }
            }
        }
        if (isset($object->value->troop)) {
            foreach ($object->value->troop as $troopId => $troopRoles) {
                foreach ($troopRoles as $roleId => $role) {
                    $this->troopRoles[$troopId][$roleId] = $role->role_name;
                }
            }
        }
        if (isset($object->value->patrol)) {
            foreach ($object->value->patrol as $patrolId => $patrolRoles) {
                foreach ($patrolRoles as $roleId => $role) {
                    $this->patrolRoles[$patrolId][$roleId] = $role->role_name;
                }
            }
        }
    }

    public function getGroupRoles()
    {
        return $this->groupRoles;
    }

    public function getTroopRoles()
    {
        return $this->troopRoles;
    }

    public function getPatrolRoles()
    {
        return $this->patrolRoles;
    }
}
