<?php

namespace Scoutorg\Tests\Scoutnet\MockServer;

use \Slim\Psr7\Request;
use Slim\Psr7\Response;

class Members extends ApiEndpoint
{
    protected function getResponse(Request $request, Response $response, $args): Response
    {
        $params = $request->getQueryParams();

        $returnObject = null;

        if (isset($params['waiting']) && $params['waiting']) {
            $returnObject = $this->getWaitingMembers();
        } else {
            $returnObject = $this->getMembers();
        }

        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write(\json_encode($returnObject));

        return $response;
    }

    private function getMembers()
    {
        $stmt = $this->db->query(
            <<<SQL
            SELECT m.*
            FROM groupmembers gm
            LEFT JOIN members m ON m.member_no = gm.member
            WHERE gm.`group` = {$this->db->quote($this->groupId)}
            SQL
        );

        $returnObject = new \stdClass;
        $returnObject->data = new \stdClass;

        while ($member = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $memberObj = new \stdClass;
            // Populate member info.
            foreach ($member as $colName => $colValue) {
                if ($colName == 'status') {
                    $status = $this->db->query("SELECT * FROM statuses WHERE id = {$this->db->quote($colValue)}")->fetch();
                    $memberObj->{$colName} = (object) [
                        'raw_value' => $status['id'],
                        'value' => $status['value']
                    ];
                } elseif ($colName == 'sex') {
                    $sex = $this->db->query("SELECT * FROM sexes WHERE id = {$this->db->quote($colValue)}")->fetch();
                    $memberObj->{$colName} = (object) [
                        'raw_value' => $sex['id'],
                        'value' => $sex['value']
                    ];
                } else {
                    $memberObj->{$colName} = (object) [
                        'value' => $colValue
                    ];
                }
            }
            // Populate membership info.
            // Group
            $group = $this->db->query("SELECT * FROM groups WHERE id = {$this->db->quote($this->groupId)}")->fetch();
            $memberObj->group = (object) [
                'raw_value' => $group['id'],
                'value' => $group['name']
            ];
            // Troop
            $troop = $this->db->query(
                <<<SQL
                SELECT
                    t.id id,
                    t.name `name`
                FROM troopmembers tm
                LEFT JOIN troops t ON t.id = tm.troop
                WHERE tm.member = {$this->db->quote($member['member_no'])}
                LIMIT 1
                SQL
            )->fetch();
            if ($troop) {
                $memberObj->unit = (object) [
                    'raw_value' => $troop['id'],
                    'value' => $troop['name']
                ];
            }
            // Patrol
            $patrol = $this->db->query(
                <<<SQL
                SELECT
                    p.id id,
                    p.name `name`
                FROM patrolmembers pm
                LEFT JOIN patrols p ON p.id = pm.patrol
                WHERE pm.member = {$this->db->quote($member['member_no'])}
                LIMIT 1
                SQL
            )->fetch();
            if ($patrol) {
                $memberObj->patrol = (object) [
                    'raw_value' => $patrol['id'],
                    'value' => $patrol['name']
                ];
            }
            // Roles
            $memberObj->roles = []; // Default value is an array???
            $roles = $this->db->query(
                <<<SQL
                SELECT
                	'group' type,
                    gm.`group` org,
                	gr.id id,
                	gr.name name
                FROM groupmembers gm
                INNER JOIN groupmemberroles gmr ON gmr.groupmember = gm.id
                INNER JOIN grouproles gr ON gr.id = gmr.role
                WHERE gm.member = {$this->db->quote($member['member_no'])}
                UNION
                SELECT
                	'troop' type,
                    tm.troop org,
                	tr.id id,
                	tr.name name
                FROM troopmembers tm
                INNER JOIN troopmemberroles tmr ON tmr.troopmember = tm.id
                INNER JOIN trooproles tr ON tr.id = tmr.role
                WHERE tm.member = {$this->db->quote($member['member_no'])}
                UNION
                SELECT
                	'patrol' type,
                    pm.patrol org,
                	pr.id id,
                	pr.name name
                FROM patrolmembers pm
                INNER JOIN patrolmemberroles pmr ON pmr.patrolmember= pm.id
                INNER JOIN patrolroles pr ON pr.id = pmr.role
                WHERE pm.member = {$this->db->quote($member['member_no'])}
                SQL
            )->fetchAll();
            if ($roles) {
                $rolesValue = new \stdClass;
                foreach ($roles as $role) {
                    if (!isset($rolesValue->{$role['type']})) {
                        $rolesValue->{$role['type']} = new \stdClass;
                    }
                    if (!isset($rolesValue->{$role['type']}->{$role['org']})) {
                        $rolesValue->{$role['type']}->{$role['org']} = new \stdClass;
                    }
                    $rolesValue->{$role['type']}->{$role['org']}->{$role['id']} = (object) [
                        'role_id' => $role['id'],
                        'role_name' => $role['name']
                    ];
                }
                $returnObject->value = $rolesValue;
            }

            $returnObject->data->{$member['member_no']} = $memberObj;
        }

        return $returnObject;
    }

    private function getWaitingMembers()
    {
        $stmt = $this->db->query(
            <<<SQL
            SELECT wm.*
            FROM groupwaitingmembers gwm
            LEFT JOIN waitingmembers wm ON wm.member_no = gwm.waitingmember
            WHERE gwm.`group` = {$this->db->quote($this->groupId)}
            SQL
        );

        $returnObject = new \stdClass;
        $returnObject->data = new \stdClass;

        while ($member = $stmt->fetch()) {
            $memberObj = new \stdClass;
            // Populate member info.
            foreach ($member as $colName => $colValue) {
                if ($colName == 'status') {
                    $status = $this->db->query("SELECT * FROM statuses WHERE id = {$this->db->quote($colValue)}")->fetch();
                    $memberObj->{$colName} = (object) [
                        'raw_value' => $status['id'],
                        'value' => $status['value']
                    ];
                } elseif ($colName == 'sex') {
                    $sex = $this->db->query("SELECT * FROM sexes WHERE id = {$this->db->quote($colValue)}")->fetch();
                    $memberObj->{$colName} = (object) [
                        'raw_value' => $sex['id'],
                        'value' => $sex['value']
                    ];
                } else {
                    $memberObj->{$colName} = (object) [
                        'value' => $colValue
                    ];
                }
            }
            // Populate membership info.
            // Group
            $group = $this->db->query("SELECT * FROM groups WHERE id = {$this->db->quote($this->groupId)}")->fetch();
            $memberObj->group = (object) [
                'raw_value' => $group['id'],
                'value' => $group['name']
            ];

            $returnObject->data->{$member['member_no']} = $memberObj;
        }

        return $returnObject;
    }
}
