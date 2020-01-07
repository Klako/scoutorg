<?php

namespace Scoutorg\Tests\Scoutnet\MockServer;

use Fig\Http\Message\StatusCodeInterface;
use Slim\Psr7\Request;
use Slim\Psr7\Response;

class GroupInfo extends ApiEndpoint 
{
    protected function getResponse(Request $request, Response $response, $args): Response
    {
        $group = $this->db->query("SELECT * FROM groups WHERE id = 1")->fetch();
        $membercount = $this->db->query("SELECT COUNT(*) FROM groupmembers WHERE `group` = 1")->fetchColumn();
        $rolecount = $this->db->query("SELECT COUNT(*) FROM membergrouproles WHERE `group` = 1")->fetchColumn();
        $waitingcount = $this->db->query("SELECT COUNT(*) FROM groupwaitingmembers WHERE `group` = 1")->fetchColumn();
        $group_email = $group['group_email'] ? 'true' : 'false';

        $leader = $this->db->query("SELECT first_name, last_name, email FROM members WHERE id = {$group['leader']}");

        $body = <<<JSON
        {
            "Group": {
                "name": "{$group['name']}",
                "membercount": $membercount,
                "rolecount": $rolecount,
                "waitingcount": $waitingcount,
                "group_email": $group_email,
                "email": "{$group['email']}",
                "description": "{$group['description']}"
            },
            "Leader": {
                "name": "{$leader['first_name']} {$leader['last_name']}",
                "contactdetails": "{$leader['email']}"
            },
            "projects": "Not in use."
        }
        JSON;

        $response = $response->withHeader('Content-Type', 'application/json');
        $response->getBody()->write($body);

        return $response;
    }
}
