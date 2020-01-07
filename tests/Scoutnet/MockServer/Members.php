<?php

namespace Scoutorg\Tests\Scoutnet\MockServer;

use Fig\Http\Message\StatusCodeInterface;
use Slim\Psr7\Response;

class Members extends ApiEndpoint
{
    public const GROUP_ID = 100;
    public const API_KEY = "uihiu23h4i2u3h498fsufs8ef";

    protected function getResponse($id, $key, $request)
    {
        if ($id != self::GROUP_ID || $key != self::API_KEY) {
            return new Response(StatusCodeInterface::STATUS_UNAUTHORIZED);
        }
    }
}