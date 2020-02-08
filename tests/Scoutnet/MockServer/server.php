<?php

use Scouterna\Scoutorg\Tests\Scoutnet\MockServer\CustomLists;
use Scouterna\Scoutorg\Tests\Scoutnet\MockServer\GroupInfo;
use Scouterna\Scoutorg\Tests\Scoutnet\MockServer\Members;
use Slim\Factory\AppFactory;

$ds = DIRECTORY_SEPARATOR;

require __DIR__ . "{$ds}..{$ds}..{$ds}..{$ds}vendor{$ds}autoload.php";

$db = new \PDO('sqlite:' . __DIR__ . "{$ds}membernet.db");
$db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

$app = AppFactory::create();

$app->add(new Tuupola\Middleware\HttpBasicAuthentication([
    'users' => [
        '1' => 'uihiu23h4i2u3h498fsufs8ef'
    ],
    'before' => function ($request, $arguments) {
        return $request->withAttribute('groupId', $arguments['user']);
    }
]));

$app->get('/api/organisation/group', new GroupInfo($db));
$app->get('/api/group/memberlist', new Members($db));
$app->get('/api/group/customlists', new CustomLists($db));

$app->run();
