<?php

namespace Scouterna\Scoutorg\Tests\Scoutnet;

use PHPUnit\Framework\TestCase;
use Scouterna\Scoutorg\Builder\ScoutorgBuilder;
use Scouterna\Scoutorg\Lib;
use Symfony\Component\Process\Process;

class ScoutorgBuilderTest extends TestCase
{
    /** @var Process */
    private static $process;

    /** @var \PDO */
    private static $db;

    static function setUpBeforeClass(): void
    {
        self::$db = new \PDO('sqlite:' . __DIR__ . '/MockServer/membernet.db');
        self::$db->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);

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

    function testGroupInfo(){
        $builder = new ScoutorgBuilder(Config::getBuilderConfig());

        $group = $builder->scoutGroups->get('scoutnet', 1);

        self::assertTrue(\get_class($group) === Lib\ScoutGroup::class);

        self::assertIsString($group->name);
    }

    function testProbe(){
        $builder = new ScoutorgBuilder(Config::getBuilderConfig());

        $group = $builder->scoutGroups->get('scoutnet', Config::getGroupConfig()->getGroupId());
        self::assertIsObject($group->troops);

        foreach ($group->troops as $troop){
            self::assertIsObject($troop->patrols);
            foreach ($troop->patrols as $patrol){
                self::assertIsObject($patrol->members);
                foreach ($patrol->members as $patrolmember){
                    self::assertIsObject($patrolmember->patrol);
                    $member = $patrolmember->member;
                    $member->patrols->get($patrol->source, $patrol->id);
                }
            }
        }
    }
}
