<?php

declare(strict_types=1);

namespace DanLapteacru\FacetWpLocalJson\Admin\Notices;

/**
 * Class FacetWpPluginIsNotActive
 *
 * @package DanLapteacru\FacetWpLocalJson
 */
class FacetWpPluginIsNotActive extends AbstractAdminNotice
{
    /**
     * Get the message.
     */
    public static function getMessage(): string
    {
        return __(
            'FacetWP plugin is not active. Please activate it to use this plugin.',
            'facetwp-local-json',
        );
    }

    /**
     * Determine if the message should be displayed.
     */
    public static function shouldDisplay(): bool
    {
        if (! function_exists('is_plugin_active')) {
            require_once ABSPATH . 'wp-admin/includes/plugin.php';
        }

        return ! is_plugin_active('facetwp/index.php');
    }
}
