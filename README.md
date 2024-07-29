# FacetWP Local JSON

FacetWP Local JSON is a WordPress plugin that allows you to store FacetWP facets, templates and settings as .json file and keep them in your source code repository.

[![Packagist Version](https://img.shields.io/packagist/v/danlapteacru/facetwp-local-json.svg?label=release&style=flat-square)](https://packagist.org/packages/danlapteacru/facetwp-local-json)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/danlapteacru/facetwp-local-json.svg?style=flat-square)](https://packagist.org/packages/danlapteacru/facetwp-local-json)
[![Packagist Downloads](https://img.shields.io/packagist/dt/danlapteacru/facetwp-local-json.svg?label=packagist%20downloads&style=flat-square)](https://packagist.org/packages/danlapteacru/facetwp-local-json/stats)
[![GitHub License](https://img.shields.io/github/license/danlapteacru/facetwp-local-json.svg?style=flat-square)](https://github.com/danlapteacru/facetwp-local-json/blob/master/LICENSE)
[![Hire Me](https://img.shields.io/badge/Hire-Me-ff69b4.svg?style=flat-square)](mailto:danlapteacru@gmail.com)

<!-- START doctoc generated TOC please keep comment here to allow auto update -->
<!-- DON'T EDIT THIS SECTION, INSTEAD RE-RUN doctoc TO UPDATE -->

- [Minimum Requirements](#minimum-requirements)
- [Installation](#installation)
- [Hooks](#hooks)
- [Constants](#constants)
- [TODO](#todo)
- [Credits](#credits)
- [License](#license)

<!-- END doctoc generated TOC please keep comment here to allow auto update -->

## Minimum Requirements

- PHP v8.1
- WordPress v6.1
- [FacetWP](https://facetwp.com) v4.0

## Installation

### Composer (Recommended)

```bash
composer require danlapteacru/facetwp-local-json
```

### WP-CLI
  
```bash
wp plugin install facetwp-local-json --activate
```

### wordpress.org plugins directory
Download from https://wordpress.org/plugins/facetwp-local-json and install it manually or via WordPress admin panel.

## Hooks

### `facetwp_local_json_settings`

Filter the settings that are stored in the .json file.

#### Example: 
```php
add_filter(
    'facetwp_local_json_settings', 
    fn (array $settings): array => [
        ...$settings,
        $settings['general']['auto_refresh'] = true,
    ],
);
```

### `facetwp_local_json_storage_path`

Filter the path where the .json files are stored. 
Default is `wp-content/themes/your-theme/plugins/facetwp/local-json/settings.json`.

#### Example: 
```php
add_filter(
    'facetwp_local_json_storage_path', 
    fn (): string => get_theme_file_path('facetwp/settings.json'),
);
```

## Constants

### `FACETWP_LOCAL_JSON_STORAGE_PATH`

Define the path where the .json files are store in your `wp-config.php` file.

#### Example:
```php
define('FACETWP_LOCAL_JSON_STORAGE_PATH', get_theme_file_path('facetwp/settings.json'));
```

### `FACETWP_LOCAL_JSON_FORCE_ENABLE`

Force enable/disable the FacetWP Local JSON features.

#### Example:
```php
define('FACETWP_LOCAL_JSON_FORCE_ENABLE', true);
```

## TODO

- [ ] Add support for WPML and Polylang.
- [ ] Option to select which facets, templates and settings to store in the .json file.
- [ ] Tests.
- [ ] Documentation.

## Credits

[FacetWP Local JSON](https://github.com/danlapteacru/facetwp-local-json) is created by [Dan Lapteacru](https://github.com/danlapteacru).

Full list of contributors can be found [here](https://github.com/danlapteacru/facetwp-local-json/graphs/contributors).

## License

[FacetWP Local JSON](https://github.com/danlapteacru/facetwp-local-json) is released under the [MIT License](https://opensource.org/licenses/MIT).
