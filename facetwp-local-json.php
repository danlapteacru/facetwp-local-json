<?php

/**
 * Plugin Name:       Local JSON for FacetWP
 * Plugin URI:        https://wordpress.org/plugins/local-json-for-facetwp/
 * Description:       Saves FacetWP facets, templates and settings as .json files within your theme.
 * Version:           0.1.0
 * Requires at least: 5.5
 * Requires PHP:      8.1
 * Author:            d1sabled - Dan Lapteacru
 * Author URI:        danlapteacru@gmail.com
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       local-json-for-facetwp
 */

declare(strict_types=1);

namespace DanLapteacru\FacetWpLocalJson;

if (! defined('WPINC')) {
    die;
}

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
} else {
    spl_autoload_register(function ($class): void {
        $prefix = 'DanLapteacru\\FacetWpLocalJson\\';
        $base_dir = __DIR__ . '/src/';
        $len = strlen($prefix);
        if (strncmp($prefix, $class, $len) !== 0) {
            return;
        }
        $relative_class = substr($class, $len);
        $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
        if (file_exists($file)) {
            require_once $file;
        }
    });
}

Plugin::run();
