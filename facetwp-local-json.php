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

// If this file is called directly, abort.
if (! defined('WPINC')) {
    die;
}

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

Plugin::run();
