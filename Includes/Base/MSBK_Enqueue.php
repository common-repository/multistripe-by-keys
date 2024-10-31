<?php

/**
 * @package MultiStripeByKeys
 */

namespace Includes\Base;

class MSBK_Enqueue
{
    public function register()
    {
        add_action('admin_enqueue_scripts', array($this, 'enqueue'));
    }


    public function enqueue()
    {
        wp_enqueue_script('msbkscript', MSBK_PLUGIN_URL . '/assets/script.js');

        //Add the Select2 CSS file
        wp_enqueue_style('select2-css', MSBK_PLUGIN_URL . '/assets/Select2/select2.min.css', array(), '4.1.0-rc.0');

        //Add the Select2 JavaScript file
        wp_enqueue_script('select2-js', MSBK_PLUGIN_URL . '/assets/Select2/select2.min.js', 'jquery', '4.1.0-rc.0');
    }
}
