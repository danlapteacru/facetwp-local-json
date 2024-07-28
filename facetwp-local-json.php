<?php

/**
 * Plugin Name:       FacetWP Local JSON
 * Plugin URI:        https://github.com/danlapteacru/facetwp-local-json/
 * Description:       Saves FacetWP facets, templates and settings as .json files within your theme.
 * Version:           0.1.0
 * Requires at least: 5.5
 * Requires PHP:      8.1
 * Author:            Dan Lapteacru
 * Author URI:        danlapteacru@gmail.com
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       facetwp-local-json
 */

declare(strict_types=1);

namespace DanLapteacru\FacetWpLocalJson;

if (! defined('WPINC')) {
    die;
}

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
} else {
    spl_autoload_register(function ($class) {
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
