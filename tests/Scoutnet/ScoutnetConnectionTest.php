<?php

namespace Scouterna\Scoutorg\Tests\Scoutnet;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;

class ScoutnetConnectionTest extends TestCase
{
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
            Config::getHost() . ':' . Config::getPort(),
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
        $connection = Config::getScoutnetConnection();
        $groupInfo = $connection->fetchGroupInfoApi();

        echo self::$process->getErrorOutput();

        self::assertIsObject($groupInfo);

        self::assertObjectHasAttribute('Group', $groupInfo);

        $group = self::$db->query("SELECT * FROM groups WHERE id = 1")->fetch();

        self::assertObjectHasAttribute('name', $groupInfo->Group);

        self::assertEquals($group['name'], $groupInfo->Group->name);
    }

    function testMembers()
    {
        $connection = Config::getScoutnetConnection();
        $members = $connection->fetchMemberListApi();

        echo self::$process->getErrorOutput();

        self::assertIsObject($members);
        self::assertObjectHasAttribute('data', $members);

        foreach ($members->data as $member) {
            self::assertIsObject($member);
        }
    }

    function testCustomLists()
    {
        $connection = Config::getScoutnetConnection();
        $customLists = $connection->fetchCustomListsApi();

        echo self::$process->getErrorOutput();

        if (empty($customLists)){
            self::assertIsArray($customLists);
        }

        self::assertIsObject($customLists);
    }
}
