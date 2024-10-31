<?php

/**
 * @package MultiStripeByKeys
 */

namespace Includes\Api\Callbacks;

class AdminCallbacks
{
    public function adminGeneral()
    {
        return include_once MSBK_PLUGIN_PATH . '/templates/msbk-admin-general.php';
    }

    public function adminVendors()
    {
        return include_once MSBK_PLUGIN_PATH . '/templates/msbk-admin-vendors.php';
    }

    public function msbkOptionsGroup($input)
    {
        return $input;
    }

    public function msbkAdminSection()
    {
    }

    public function msbkTextCallback($input)
    {
        $ref = esc_attr($input['label_for']);
        $value = esc_attr(get_option($ref));
        echo '<input 
        type="text" 
        class="regular-text" 
        name="' . $ref . '" 
        value="' . $value . '" 
        placeholder="' . (isset($input['placeholder']) ? esc_html($input['placeholder']) : '') . '">';
    }

    public function msbkNumberCallback($input)
    {
        $ref = esc_attr($input['label_for']);
        $value = esc_attr(get_option($ref));
        echo '<input 
        type="number" 
        class="regular-number" 
        name="' . $ref . '" 
        value="' . $value . '" 
        placeholder="' . (isset($input['placeholder']) ? esc_html($input['placeholder']) : '') . '">';
    }

    public function msbkCheckBoxCallback($input)
    {
        $ref = esc_attr($input['label_for']);
        $value = esc_attr(get_option($ref));
        echo '<input 
        type="checkbox" 
        class="regular-checkbox" 
        name="' . $ref . '" 
        value="1"' . checked(1 == $value, true, false) . '>';
        echo '<p class="description">' . esc_html($input['description']) . '</p>';
    }
}
