<?php

namespace Scoutorg\Tests\Scoutnet;

use PHPUnit\Framework\TestCase;
use Scoutorg\Scoutnet\ScoutGroupConfig;
use Scoutorg\Scoutnet\ScoutnetConnection;
use Symfony\Component\Process\Process;

class ScoutnetConnectionTest extends TestCase
{
    /** @var int */
    private const PORT = 9080;

    /** @var Process */
    private static $process;

    /** @var \PDO */
    private static $db;

    static function setUpBeforeClass(): void
    {
        self::$db = new \PDO('sqlite:' . __DIR__ . '/MockServer/membernet.db');

        self::$process = new Process([
            "php",
            "-S",
            "localhost:" . self::PORT,
            __DIR__ . \DIRECTORY_SEPARATOR . "MockServer" . \DIRECTORY_SEPARATOR . "server.php"
        ]);

        self::$process->start();

        \usleep(100000);
    }

    static function tearDownAfterClass(): void
    {
        self::$process->stop();
    }

    function testGroupInfo()
    {
        $groupConfig = new ScoutGroupConfig(
            1,
            'uihiu23h4i2u3h498fsufs8ef',
            'uihiu23h4i2u3h498fsufs8ef',
            'uihiu23h4i2u3h498fsufs8ef'
        );

        $connection = new ScoutnetConnection($groupConfig, 'localhost', self::PORT);

        $groupInfo = $connection->fetchGroupInfoApi();

        echo self::$process->getErrorOutput();

        self::assertIsObject($groupInfo, 'Returned value is not an object, failed fetching group info');

        self::assertObjectHasAttribute('Group', $groupInfo, "returned object must have Group attribute");

        $group = self::$db->query("SELECT * FROM groups WHERE id = 1")->fetch();

        self::assertObjectHasAttribute('name', $groupInfo->Group, 'Returned object must have name attribute');

        self::assertEquals($group['name'], $groupInfo->Group->name, "Wrong name in group");
    }

    function testMembers()
    {
        $groupConfig = new ScoutGroupConfig(
            1,
            'uihiu23h4i2u3h498fsufs8ef',
            'uihiu23h4i2u3h498fsufs8ef',
            'uihiu23h4i2u3h498fsufs8ef'
        );

        $connection = new ScoutnetConnection($groupConfig, 'localhost', self::PORT);
        $members = $connection->fetchMemberListApi();

        echo self::$process->getErrorOutput();

        self::assertIsObject($members, 'Returned value is not an object, failed fetching member list');
        self::assertObjectHasAttribute('data', $members, "Returned object must have a 'data' member");

        foreach ($members->data as $member) {
            self::assertIsObject($member, 'All returned members must be objects');

            
        }
    }
}
