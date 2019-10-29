<?php

namespace Scoutorg\Scoutnet;

/**
 * A collection of roles in the scout group.
 * @property-read string[] $groupRoles
 * @property-read string[] $troopRoles
 * @property-read string[] $patrolRoles
 */
class Roles {
    private $properties;

    public function __construct($object) {
        $this->properties = [];
        $this->properties['groupRoles'] = [];
        $this->properties['troopRoles'] = [];
        $this->properties['patrolRoles'] = [];
        if (isset($object->value)) {
            if (isset($object->value->group)) {
                foreach ($object->value->group as $groupId => $groupRoles) {
                    foreach ($groupRoles as $roleId => $groupRole) {
                        $this->properties['groupRoles'][$roleId] = $groupRole->role_name;
                    }
                }
            }
            if (isset($object->value->troop)) {
                foreach ($object->value->troop as $troopId => $troopRoles) {
                    foreach ($troopRoles as $roleId => $troopRole) {
                        $this->properties['troopRoles'][$troopId] = $troopRole->role_name;
                    }
                }
            }
            if (isset($object->value->patrol)) {
                foreach ($object->value->patrol as $patrolId => $patrolRoles) {
                    foreach ($patrolRoles as $roleId => $patrolRole) {
                        $this->properties['patrolRoles'][$patrolId] = $patrolRole->role_name;
                    }
                }
            }
        }
    }

    public function __get($name) {
        return isset($this->properties[$name]) ? $this->properties[$name] : null;
    }

    public function __isset($name){
        return isset($this->properties[$name]);
    }
}