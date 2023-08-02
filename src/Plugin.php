<?php

declare(strict_types=1);

namespace DanLapteacru\FacetWpLocalJson;

use DanLapteacru\FacetWpLocalJson\Admin\Notices\FacetWpPluginIsNotActive;

/**
 * Class Plugin
 *
 * @package DanLapteacru\FacetWpLocalJson
 */
final class Plugin
{
    /**
     * Holds the class instance.
     */
    private static ?Plugin $instance = null;

    /**
     * Plugin constructor.
     */
    public static function run(): ?Plugin
    {
        if (FacetWpPluginIsNotActive::shouldDisplay()) {
            add_action('admin_notices', [FacetWpPluginIsNotActive::class, 'display']);
            return null;
        }

        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}
