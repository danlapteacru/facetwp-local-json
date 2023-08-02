<?php

declare(strict_types=1);

namespace DanLapteacru\FacetWpLocalJson\Admin\Notices;

abstract class AbstractAdminNotice
{
    protected static string $type = 'error';

    /**
     * Show the message.
     */
    public static function display(): void
    {
        if (! static::shouldDisplay() || empty(static::getMessage())) {
            return;
        }

        static::displayMessage();
    }

    /**
     * Determine if the message should be displayed.
     */
    public static function shouldDisplay(): bool
    {
        return false;
    }

    /**
     * Get the message.
     */
    public static function getMessage(): string
    {
        return '';
    }

    /**
     * Display the message.
     */
    protected static function displayMessage(): void
    {
        printf(
            '<div class="notice notice-%s"><p>%s</p></div>',
            esc_attr(static::$type),
            esc_html(static::getMessage()),
        );
    }
}
