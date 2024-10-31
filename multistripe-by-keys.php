<?php

/** 
 * Plugin Name:  MultiStripe by Keys
 * Description:  The ideal tool for all marketplaces, e-commerce or franchise wishing to have a common collection solution with individual payments for each vendor. 
 * Plugin URI:   https://www.webfresk.com/plugin
 * Version:      1.0.0
 * Author:       Webfresk
 * Author URI:   https://www.webfresk.com
 * License: GPLv2 or later
 * Text Domain:  multistripe-by-keys
 * Requires at least: 5.7
 * Requires PHP: 7.2
 * 
 * @package MultiStripeByKeys
 */

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

defined('ABSPATH') || die;

//Define constants
define('MSBK_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('MSBK_PLUGIN_URL', plugin_dir_url(__FILE__));
define('MSBK_PLUGIN_NAME', plugin_basename(__FILE__));

//Require the Composer Autoload
if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
    require_once dirname(__FILE__) . '/vendor/autoload.php';
}

/**
 * The code that runs during plugin activation
 */
function activate_msbk()
{
    Includes\Base\MSBK_Activate::activate();
}
register_activation_hook(__FILE__, 'activate_msbk');

/**
 * The code that runs during plugin deactivation
 */
function deactivate_msbk()
{
    Includes\Base\MSBK_Deactivate::deactivate();
}
register_deactivation_hook(__FILE__, 'deactivate_msbk');

/**
 * Initialisation
 */
if (class_exists('Includes\\MSBK_Init')) {
    Includes\MSBK_Init::register_services();
}
