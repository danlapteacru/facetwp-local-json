<?php

declare(strict_types=1);

namespace DanLapteacru\FacetWpLocalJson;

use DanLapteacru\FacetWpLocalJson\Admin\Settings;

/**
 * Class Plugin
 *
 * @package DanLapteacru\FacetWpLocalJson
 */
class Sync
{
    /**
     * Holds the class instance.
     */
    protected static ?Sync $instance = null;

    /**
     * FacetWP settings option key.
     */
    protected string $facetWpSettingsOptionKey = 'facetwp_settings';

    public function __construct()
    {
        // Load FacetWP settings from storage.
        add_filter('option_' . $this->facetWpSettingsOptionKey, [static::class, 'loadFacetWpSettings']);

        // Save FacetWP settings to storage.
        add_action(
            'update_option_' . $this->facetWpSettingsOptionKey,
            [static::class, 'saveFacetWpSettings'],
            10,
            3,
        );
    }

    /**
     * Plugin constructor.
     */
    public static function run(): ?Sync
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function getStoragePath(): string
    {
        // Allow to change the storage path with a filter.
        $storagePath = apply_filters('facetwp_local_json_storage_path', '');
        if (! empty($storagePath)) {
            return $storagePath;
        }

        // Allow to change the storage path with a wp-config.php constant.
        if (
            defined('FACETWP_LOCAL_JSON_STORAGE_PATH')
            && ! empty(constant('FACETWP_LOCAL_JSON_STORAGE_PATH'))
        ) {
            return constant('FACETWP_LOCAL_JSON_STORAGE_PATH');
        }

        $storagePathSuffix = apply_filters(
            'facetwp_local_json_storage_path_suffix',
            '/plugins/facetwp/local-json/settings.json',
        );

        // Check if Acorn exists.
        if (class_exists('\Roots\Acorn\Application') && function_exists('storage_path')) {
            return storage_path($storagePathSuffix);
        }

        return get_theme_file_path($storagePathSuffix);
    }

    public static function isLocalJsonEnabled(string $settings): bool
    {
        if (
            defined('FACETWP_LOCAL_JSON_FORCE_ENABLE')
            && is_bool(constant('FACETWP_LOCAL_JSON_FORCE_ENABLE'))
        ) {
            return constant('FACETWP_LOCAL_JSON_FORCE_ENABLE');
        }

        $json = json_decode($settings, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            return false;
        }

        return 'yes' === ($json['settings'][Settings::ENABLE_FACETWP_LOCAL_JSON_FIELD_KEY] ?? '');
    }

    /**
     * Load FacetWP settings from storage, if available.
     * That's needed to keep the settings into git.
     */
    public static function loadFacetWpSettings(mixed $value): mixed
    {
        if (! is_string($value) || ! static::isLocalJsonEnabled($value)) {
            return $value;
        }

        $storagePath = static::getStoragePath();
        if (! file_exists($storagePath)) {
            return $value;
        }

        //phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents, Generic.PHP.ForbiddenFunctions.Found
        $settings = file_get_contents($storagePath);
        if (empty($settings)) {
            return $value;
        }

        return $settings;
    }

    /**
     * Save FacetWP settings to storage, if available.
     * That's needed to keep the settings into git.
     */
    public static function saveFacetWpSettings(mixed $oldValue, mixed $value, string $option): void
    {
        if (! is_string($value) || ! static::isLocalJsonEnabled($value)) {
            return;
        }

        $storagePath = static::getStoragePath();
        if (! file_exists($storagePath)) {
            $path = dirname($storagePath);

            if (! file_exists($path)) {
                //phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_operations_mkdir
                $result = mkdir($path, 0777, true);
                if (! $result) {
                    return;
                }
            }

            // bail early if dir does not exist.
            if (! wp_is_writable($path)) {
                return;
            }
        }

        // phpcs:ignore WordPress.WP.AlternativeFunctions.file_system_read_file_put_contents
        file_put_contents(
            $storagePath,
            $value,
        );
    }
}
