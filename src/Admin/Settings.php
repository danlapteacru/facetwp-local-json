<?php

declare(strict_types=1);

namespace DanLapteacru\FacetWpLocalJson\Admin;

use FacetWP_Settings;

class Settings
{
    /**
     * Holds the class instance.
     */
    private static ?self $instance = null;

    /**
     * @var array Default settings.
     */
    protected array $defaults = [];

    /**
     * @var FacetWP_Settings FacetWP settings instance.
     */
    protected ?FacetWP_Settings $settingsInstance = null;

    /**
     * Settings constructor.
     */
    public function __construct()
    {
        // Add custom fields to FacetWP settings.
        add_filter(
            'facetwp_settings_admin',
            [$this, 'settingsAdminFilter'],
            10,
            2,
        );
    }

    /**
     * Initialize the class.
     */
    public static function init(): self
    {
        if (null === static::$instance) {
            static::$instance = new self();
        }

        return static::$instance;
    }

    /**
     * Add custom fields to FacetWP settings.
     *
     * @param array            $defaults Default settings.
     * @param FacetWP_Settings $settingsInstance FacetWP settings instance.
     *
     * @return array
     */
    public function settingsAdminFilter(array $defaults, FacetWP_Settings $settingsInstance): array
    {
        $this->defaults = $defaults;
        $this->settingsInstance = $settingsInstance;

        static::addEnableDisableLocalJsonToggle();

        return apply_filters(
            'facetwp_local_json_settings',
            $this->defaults,
            $this->settingsInstance,
        );
    }

    /**
     * Add option to enable/disable local JSON.
     */
    public function addEnableDisableLocalJsonToggle(): void
    {
        $this->defaults['facetwp_local_json'] = [
            'label' => esc_html__('Local JSON', 'facetwp-local-json'),
            'fields' => [
                'enable_facetwp_local_json' => [
                    'label' => esc_html__('Enable FacetWP Local JSON', 'facetwp-local-json'),
                    'notes' => esc_html__(
                        'Save FacetWP facets, templates and settings as .json files within your theme.',
                        'facetwp-local-json',
                    ),
                    'html' => $this->settingsInstance->
                        get_setting_html('enable_facetwp_local_json', 'toggle', [
                            'true_value' => 'yes',
                            'false_value' => 'no',
                        ]),
                ],
            ],
        ];
    }
}
