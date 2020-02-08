<?php

namespace Scouterna\Scoutorg\Tests\Scoutnet;

use PHPUnit\Framework\TestCase;
use Scouterna\Scoutorg\Scoutnet\GroupInfo;
use Scouterna\Scoutorg\Scoutnet\Member;
use Scouterna\Scoutorg\Scoutnet\ScoutnetController;
use Scouterna\Scoutorg\Scoutnet\Value;
use Scouterna\Scoutorg\Scoutnet\WaitingMember;
use Symfony\Component\Process\Process;

class ScoutnetControllerTest extends TestCase
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
        $db = self::$db;

        $controller = new ScoutnetController(Config::getScoutnetConnection());
        $groupInfo = $controller->getGroupInfo();

        self::assertIsObject($groupInfo);

        self::assertTrue(\get_class($groupInfo) == GroupInfo::class);

        $groupId = Config::getGroupConfig()->getGroupId();
        $dbgroup = $db->query(
            "SELECT * FROM groups WHERE id = {$db->quote($groupId)}"
        )->fetch();

        self::assertEquals($dbgroup['name'], $groupInfo->name);
        self::assertEquals($dbgroup['description'], $groupInfo->description);
        self::assertEquals((bool) $dbgroup['group_email'], $groupInfo->group_email);
        self::assertEquals($dbgroup['email'], $groupInfo->email);
    }

    function testMemberlist()
    {
        $db = self::$db;

        $controller = new ScoutnetController(Config::getScoutnetConnection());

        $members = $controller->getMemberList();

        $groupId = Config::getGroupConfig()->getGroupId();

        self::assertIsArray($members);

        $dbmembers = $db->query(
            <<<SQL
            SELECT m.*
            FROM groupmembers gm
            LEFT JOIN members m ON m.member_no = gm.member
            WHERE gm.`group` = {$db->quote($groupId)}
            SQL
        )->fetchAll();

        foreach ($dbmembers as $dbmember) {
            self::assertArrayHasKey($dbmember['member_no'], $members);
            $member = $members[$dbmember['member_no']];
            self::assertIsObject($member);
            self::assertTrue($member instanceof Member);
            foreach ($dbmember as $colName => $colValue) {
                self::assertIsObject($member->{$colName});
                if (\get_class($member->{$colName}) == Value::class) {
                    self::assertEquals($colValue, $member->{$colName}->value);
                } else {
                    if ($colName == 'sex') {
                        $sex = $db->query(
                            "SELECT * FROM sexes WHERE id = {$db->quote($member->sex->rawValue)}"
                        )->fetch();
                        self::assertNotFalse($sex);
                        self::assertEquals($sex['id'], $member->sex->rawValue);
                        self::assertEquals($sex['value'], $member->sex->value);
                    } elseif ($colName == 'status') {
                        $status = $db->query(
                            "SELECT * FROM statuses WHERE id = {$db->quote($member->status->rawValue)}"
                        )->fetch();
                        self::assertNotFalse($status);
                        self::assertEquals($status['id'], $member->status->rawValue);
                        self::assertEquals($status['value'], $member->status->value);
                    }
                }
            }
        }
    }

    function testWaitingList()
    {
        $db = self::$db;

        $controller = new ScoutnetController(Config::getScoutnetConnection());

        $waitinglist = $controller->getWaitingList();
        self::assertIsArray($waitinglist);

        $groupId = Config::getGroupConfig()->getGroupId();
        $dbwaitinglist = $db->query(
            <<<SQL
            SELECT m.*
            FROM groupwaiters gw
            LEFT JOIN members m ON m.member_no = gw.member
            WHERE gw.`group` = {$db->quote($groupId)}
            SQL
        )->fetchAll();

        foreach ($dbwaitinglist as $dbmember) {
            self::assertArrayHasKey($dbmember['member_no'], $waitinglist);
            $member = $waitinglist[$dbmember['member_no']];
            self::assertIsObject($member);
            self::assertTrue($member instanceof WaitingMember);

            foreach ($dbmember as $colName => $colValue) {
                self::assertIsObject($member->{$colName});
                if (\get_class($member->{$colName}) == Value::class) {
                    self::assertEquals($colValue, $member->{$colName}->value);
                } else {
                    if ($colName == 'sex') {
                        $sex = $db->query(
                            "SELECT * FROM sexes WHERE id = {$db->quote($member->sex->rawValue)}"
                        )->fetch();
                        self::assertNotFalse($sex);
                        self::assertEquals($sex['id'], $member->sex->rawValue);
                        self::assertEquals($sex['value'], $member->sex->value);
                    } elseif ($colName == 'status') {
                        $status = $db->query(
                            "SELECT * FROM statuses WHERE id = {$db->quote($member->status->rawValue)}"
                        )->fetch();
                        self::assertNotFalse($status);
                        self::assertEquals($status['id'], $member->status->rawValue);
                        self::assertEquals($status['value'], $member->status->value);
                    }
                }
            }
        }
    }

    function testCustomLists()
    {
        $db = self::$db;

        $controller = new ScoutnetController(Config::getScoutnetConnection());

        $lists = $controller->getCustomLists();

        self::assertIsArray($lists);

        $groupId = Config::getGroupConfig()->getGroupId();
        $dblists = $db->query(
            "SELECT * FROM customlists WHERE `group` = {$db->quote($groupId)}"
        )->fetchAll();

        foreach ($dblists as $dblist) {
            self::assertArrayHasKey($dblist['id'], $lists);

            $list = $lists[$dblist['id']];
            self::assertIsString($list->id);
            self::assertEquals($dblist['id'], $list->id);
            self::assertIsString($list->title);
            self::assertEquals($dblist['title'], $list->title);
            self::assertIsString($list->description);
            self::assertEquals($dblist['description'], $list->description);
            self::assertIsArray($list->rules);

            $listmembers = $controller->getCustomListMembers($dblist['id']);

            self::assertIsArray($listmembers);

            $dblistmembers = $db->query(
                <<<SQL
                SELECT m.member_no, m.email, m.first_name, m.last_name
                FROM members m
                LEFT JOIN customlistrulemembers clrm ON clrm.member = m.member_no
                LEFT JOIN customlistrules clr ON clr.id = clrm.customlistrule
                WHERE clr.customlist = {$db->quote($dblist['id'])}
                SQL
            )->fetchAll();
            self::checkListMembers($listmembers, $dblistmembers);

            $dblistrules = $db->query(
                "SELECT * FROM customlistrules WHERE customlist = {$db->quote($dblist['id'])}"
            )->fetchAll();
            foreach ($dblistrules as $dblistrule) {
                self::assertArrayHasKey($dblistrule['id'], $list->rules);

                $listrule = $list->rules[$dblistrule['id']];
                self::assertIsString($listrule->id);
                self::assertEquals($dblistrule['id'], $listrule->id);
                self::assertIsString($listrule->title);
                self::assertEquals($dblistrule['title'], $listrule->title);

                $listrulemembers = $controller->getCustomListMembers($dblist['id'], $dblistrule['id']);

                $dblistrulemembers = $db->query(
                    <<<SQL
                    SELECT m.member_no, m.email, m.first_name, m.last_name
                    FROM members m
                    LEFT JOIN customlistrulemembers clrm ON clrm.member = m.member_no
                    LEFT JOIN customlistrules clr ON clr.id = clrm.customlistrule
                    WHERE clr.id = {$db->quote($dblistrule['id'])}
                    SQL
                );
                self::checkListMembers($listrulemembers, $dblistrulemembers);
            }
        }
    }

    /**
     * Checks that list members are equal to their database equivalents.
     * @param \Scouterna\Scoutorg\Scoutnet\CustomListMember[] $listmembers
     * @param array $dblistmembers
     */
    private static function checkListMembers(&$listmembers, &$dblistmembers)
    {
        foreach ($dblistmembers as $dblistmember) {
            self::assertArrayHasKey($dblistmember['member_no'], $listmembers);
            $listmember = $listmembers[$dblistmember['member_no']];

            self::assertIsString($listmember->member_no->value);
            self::assertEquals($dblistmember['member_no'], $listmember->member_no->value);
            self::assertIsString($listmember->email->value);
            self::assertEquals($dblistmember['email'], $listmember->email->value);
            self::assertIsString($listmember->first_name->value);
            self::assertEquals($dblistmember['first_name'], $listmember->first_name->value);
            self::assertIsString($listmember->last_name->value);
            self::assertEquals($dblistmember['last_name'], $listmember->last_name->value);
        }
    }
}
