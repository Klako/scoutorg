<?php

namespace Scoutorg\Tests\Scoutnet\MockServer;

use Slim\Psr7\Request;
use Slim\Psr7\Response;

class CustomListMembers extends ApiEndpoint
{
    protected function getResponse(Request $request, Response $response, $args): Response
    {
        return $response;
    }
}