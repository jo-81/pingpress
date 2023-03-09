<?php

namespace Inc\Module;

if (! defined('ABSPATH')) {
    exit;
}

/**
 * OptionModule
 * Enregistrement des différentes options
 */
final class OptionModule
{    
    /**
     * registerOptions
     *
     * @param  string $optionName
     * @param  mixed $value
     * @return mixed
     */
    public function registerOptions(string $optionName, mixed $value): mixed
    {
        $option = get_option($optionName);
        $sanitizeValues = map_deep($value, 'sanitize_text_field');

        if (! $option && ! empty($option)) {
            return add_option($optionName, $sanitizeValues);
        }

        return update_option($optionName, $sanitizeValues);
    }
}