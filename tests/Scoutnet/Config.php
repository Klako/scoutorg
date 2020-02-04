<?php

namespace Scoutorg\Tests\Scoutnet;

use Scoutorg\Builder\Config as BuilderConfig;
use Scoutorg\Scoutnet\ScoutGroupConfig;
use Scoutorg\Scoutnet\ScoutnetConnection;
use Scoutorg\Scoutnet\ScoutnetController;
use Scoutorg\Scoutnet\PartFactory;
use Scoutorg\Scoutnet\PartProvider;
use Scoutorg\Lib;

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

    public static function getScoutorgConfig()
    {
        $handler = self::getScoutorgHandler();

        $config = new BuilderConfig();
        $config->addProvider('scoutnet', $handler);

        return $config;
    }

    /**
     * Gets default scoutorg factory
     * @return PartProvider
     */
    public static function getScoutorgHandler()
    {
        $controller = new ScoutnetController(self::getScoutnetConnection());
        return new PartProvider($controller);
    }
}
