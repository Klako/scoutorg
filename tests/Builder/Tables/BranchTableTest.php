<?php

namespace Scouterna\Scoutorg\Tests\Builder\Tables;

use PHPUnit\Framework\TestCase;
use Scouterna\Scoutorg\Builder\Bases;
use Scouterna\Scoutorg\Builder\Config;
use Scouterna\Scoutorg\Builder\ScoutorgBuilder;
use Scouterna\Scoutorg\Builder\Tables\BranchTable;
use Scouterna\Scoutorg\Model\Uid;

class BranchTableTest extends TestCase
{
    public function testGetSingleObject()
    {
        $provider = new SimpleProvider();
        $branchName = 'branch';
        $uid = new Uid('test', '1');
        $provider->setBasePart(
            Bases\BranchBase::class,
            $uid->id,
            new Bases\BranchBase($branchName)
        );
        $config = new Config();
        $config->addProvider($uid->source, $provider);
        $scoutorg = new ScoutorgBuilder($config);
        $instance = new BranchTable($config, $scoutorg);
        $result = $instance->get($uid);
        self::assertIsObject($result);
        self::assertEquals($branchName, $result->name);
        self::assertEmpty($result->troops);
        self::assertEquals($uid->serialized, $result->uid->serialized);
    }
}
