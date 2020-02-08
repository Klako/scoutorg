<?php

namespace Scouterna\Scoutorg\Tests\Scoutnet;

use Scouterna\Scoutorg\Builder\Config as BuilderConfig;
use Scouterna\Scoutorg\Scoutnet\ScoutGroupConfig;
use Scouterna\Scoutorg\Scoutnet\ScoutnetConnection;
use Scouterna\Scoutorg\Scoutnet\ScoutnetController;
use Scouterna\Scoutorg\Scoutnet\PartFactory;
use Scouterna\Scoutorg\Scoutnet\PartProvider;
use Scouterna\Scoutorg\Lib;

class Config
{
    public static function getHost()
    {
        return 'localhost';
    }

    public static function getPort()
    {
        return 9080;
    }

    public static function getGroupConfig()
    {
        return new ScoutGroupConfig(
            1,
            'uihiu23h4i2u3h498fsufs8ef',
            'uihiu23h4i2u3h498fsufs8ef',
            'uihiu23h4i2u3h498fsufs8ef'
        );
    }

    /** 
     * Gets default scoutnet connection
     * @return ScoutnetConnection
     */
    public static function getScoutnetConnection()
    {
        return new ScoutnetConnection(
            self::getGroupConfig(),
            self::getHost(),
            self::getPort()
        );
    }

    public static function getBuilderConfig()
    {
        $handler = self::getScoutnetPartProvider();

        $config = new BuilderConfig();
        $config->addProvider('scoutnet', $handler);

        return $config;
    }

    /**
     * Gets default Scouterna\Scoutorg factory
     * @return PartProvider
     */
    public static function getScoutnetPartProvider()
    {
        $controller = new ScoutnetController(self::getScoutnetConnection());
        return new PartProvider($controller);
    }
}
