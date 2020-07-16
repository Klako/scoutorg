<?php

namespace Scouterna\Scoutorg\Tests\Scoutnet;

use PHPUnit\Framework\TestCase;
use Scouterna\Scoutorg\Builder\ScoutorgBuilder;
use Scouterna\Scoutorg\Builder\Uid;
use Scouterna\Scoutorg\Lib;
use Scouterna\Scoutorg\Lib\Contact;
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

    function testGroupInfo()
    {
        $builder = new ScoutorgBuilder(Config::getBuilderConfig());

        $uid = new Uid('scoutnet', Config::getGroupConfig()->getGroupId());

        $group = $builder->scoutGroups->get($uid);

        self::assertTrue(\get_class($group) === Lib\ScoutGroup::class);

        self::assertIsString($group->name);
    }

    function testProbe()
    {
        $builder = new ScoutorgBuilder(Config::getBuilderConfig());

        $uid = new Uid('scoutnet', Config::getGroupConfig()->getGroupId());

        $group = $builder->scoutGroups->get($uid);

        self::assertIsObject($group->troops);
        foreach ($group->troops as $troop) {
            self::assertIsObject($troop->patrols);
            foreach ($troop->patrols as $patrol) {
                self::assertIsObject($patrol->members);
                foreach ($patrol->members as $patrolmember) {
                    self::assertIsObject($patrolmember->patrol);
                    $member = $patrolmember->member;
                    $member->patrols->get($patrol->source, $patrol->id);
                }
            }
        }
    }

    function testTroopRoles()
    {
        $builder = new ScoutorgBuilder(Config::getBuilderConfig());

        $uid = new Uid('scoutnet', Config::getGroupConfig()->getGroupId());

        $group = $builder->scoutGroups->get($uid);

        self::assertIsObject($group->troopRoles);

        $dbtrooproles = self::$db->query("SELECT DISTINCT role_id FROM v_trooproles")->fetchAll();

        foreach ($dbtrooproles as $dbtrooprole) {
            self::assertIsObject($group->troopRoles->get('scoutnet', $dbtrooprole['role_id']));
        }
    }

    function testPatrolRoles()
    {
        $builder = new ScoutorgBuilder(Config::getBuilderConfig());

        $uid = new Uid('scoutnet', Config::getGroupConfig()->getGroupId());

        $group = $builder->scoutGroups->get($uid);

        self::assertIsObject($group->patrolRoles);
        
        $dbpatrolroles = self::$db->query("SELECT DISTINCT role_id FROM v_patrolroles")->fetchAll();
        
        foreach ($dbpatrolroles as $dbpatrolrole) {
            self::assertIsObject($group->patrolRoles->get('scoutnet', $dbpatrolrole['role_id']));
        }
        
    }

    function testNullTroopBranches()
    {
        $builder = new ScoutorgBuilder(Config::getBuilderConfig());

        $uid = new Uid('scoutnet', Config::getGroupConfig()->getGroupId());

        $group = $builder->scoutGroups->get($uid);

        self::assertIsObject($group->troops);

        foreach ($group->troops as $troop){
            $branch = $troop->branch;
        }
    }
}
