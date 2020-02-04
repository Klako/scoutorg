<?php

namespace Scoutorg\Tests\Scoutnet;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\Process;

class ScoutorgBuilderTest extends TestCase
{
    /** @var Process */
    private static $process;

    /** @var \PDO */
    private static $db;

    private static $builder;

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
}
