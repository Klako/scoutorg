<?php

use Scoutorg\Tests\Scoutnet\MockServer\GroupInfo;
use Slim\Factory\AppFactory;

$ds = DIRECTORY_SEPARATOR;

require __DIR__ . "{$ds}..{$ds}..{$ds}..{$ds}vendor{$ds}autoload.php";

$db = new \PDO('sqlite:'.__DIR__."{$ds}membernet.db");

$app = AppFactory::create();

$app->add(new Tuupola\Middleware\HttpBasicAuthentication([
    'users' => [
        '1' => 'uihiu23h4i2u3h498fsufs8ef'
    ]
]));

$app->get('/api/organisation/group', new GroupInfo($db));

$app->run();