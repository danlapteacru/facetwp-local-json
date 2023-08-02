<?php

declare(strict_types=1);

namespace DanLapteacru\FacetWpLocalJson;

/**
 * Class Plugin
 *
 * @package DanLapteacru\FacetWpLocalJson
 */
final class Plugin
{
    /**
     * Holds the class instance.
     *
     * @var null|Plugin $instance
     */
    private static ?Plugin $instance = null;

    /**
     * Plugin constructor.
     *
     * @return Plugin
     */
    public static function run(): Plugin
    {
        if (null === Plugin::$instance) {
            Plugin::$instance = new self();
        }

        return Plugin::$instance;
    }
}
