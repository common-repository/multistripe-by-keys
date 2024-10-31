<?php

/**
 * @package MultiStripeByKeys
 */

namespace Includes\Base;

class MSBK_SettingsLink
{
    public function register() {
        add_filter( "plugin_action_links_" . MSBK_PLUGIN_NAME, array($this, 'settings_link'));
    }

    static function settings_link( $links ){
        $settings_link = '<a href="admin.php?page=msbk_admin">Réglages</a>';
        array_push( $links, $settings_link );
        return $links;
    }
}
