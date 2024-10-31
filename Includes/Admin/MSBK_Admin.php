<?php

/**
 * @package MultiStripeByKeys
 */

namespace Includes\Admin;

use Includes\Api\MSBK_SettingsApi;
use Includes\Api\Callbacks\AdminCallbacks;

class MSBK_Admin
{
    public $settings;
    public $callbacks;

    public $adminPage = array();
    public $subpages = array();

    /**
     * Constructor for the admin page for MSBK
     */
    public function __construct()
    {
        $this->settings = new MSBK_SettingsApi();

        $this->callbacks = new AdminCallbacks();

        $this->adminPage = [
            "page_title" => 'MSBK Plugin', // Title of the page
            "menu_title" => 'MSBK Settings', // Text to show on the menu link
            "capability" => 'manage_options', // Capability requirement to see the link
            "menu_slug" => 'msbk_admin', // The 'slug' - file to display when clicking the link
            "callback" => [$this->callbacks, 'adminGeneral'],
            "icon_url" => 'dashicons-admin-multisite',
            "position" => 110
        ];

        $this->subpages = [
            [
                "parent_slug"   => $this->adminPage['menu_slug'],
                "page_title"    => 'Vendors',
                "menu_title"    => 'Vendors',
                "capability"    => 'manage_options',
                "menu_slug"     => 'msbk_vendors',
                "callback"      => [$this->callbacks, 'adminVendors']
            ]
        ];
    }

    /**
     * Register method call at initialisation
     */
    public function register()
    {
        $this->setSettings();
        $this->setSections();
        $this->setFields();

        $this->settings->addPage($this->adminPage)->withSubPage('General')->addSubPages($this->subpages)->register();
    }

    /**
     * Set the settings for MSBK general parameters
     */
    public function setSettings()
    {
        $args = [
            [
                'option_group' => 'msbk_options_group',
                'option_name' => 'number_vendor_option',
                'callback' => [$this->callbacks, 'msbkOptionsGroup']
            ],
            [
                'option_group' => 'msbk_options_group',
                'option_name' => 'is_activate_test_option'
            ],
            [
                'option_group' => 'msbk_options_group',
                'option_name' => 'is_activate_live_option'
            ],
            [
                'option_group' => 'msbk_options_group',
                'option_name' => 'msbk_api_key'
            ]
        ];

        $this->settings->setSettings($args);
    }

    /**
     * Set the sections for MSBK general parameters
     */
    public function setSections()
    {
        $args = [
            [
                'id' => 'msbk_admin_index',
                'title' => '',
                'callback' => [$this->callbacks, 'msbkAdminSection'],
                'page' => 'msbk_admin'
            ]
        ];

        $this->settings->setSections($args);
    }

    /**
     * Set the fields for MSBK general parameters
     */
    public function setFields()
    {
        $args = [
            [
                'id' => 'number_vendor_option',
                'title' => 'Number of :',
                'callback' => [$this->callbacks, 'msbkNumberCallback'],
                'page' => 'msbk_admin',
                'section' => 'msbk_admin_index',
                'args' => [
                    'label_for' => 'number_vendor_option',
                    'placeholder' => 'Number of Vendor'
                ]
            ],
            [
                'id' => 'is_activate_test_option',
                'title' => 'Activate Test mode :',
                'callback' => [$this->callbacks, 'msbkCheckBoxCallback'],
                'page' => 'msbk_admin',
                'section' => 'msbk_admin_index',
                'args' => [
                    'label_for' => 'is_activate_test_option',
                    'description' => 'Woocommerce Stripe need to be in test mode too !'
                ]
            ],
            [
                'id' => 'is_activate_live_option',
                'title' => 'Activate Live mode :',
                'callback' => [$this->callbacks, 'msbkCheckBoxCallback'],
                'page' => 'msbk_admin',
                'section' => 'msbk_admin_index',
                'args' => [
                    'label_for' => 'is_activate_live_option',
                    'description' => 'Woocommerce Stripe need to be in live mode too ! If test mode is activate live mode will not work'
                ]
            ]
            ,
            [
                'id' => 'msbk_api_key',
                'title' => 'API key for premium :',
                'callback' => [$this->callbacks, 'msbkTextCallback'],
                'page' => 'msbk_admin',
                'section' => 'msbk_admin_index',
                'args' => [
                    'label_for' => 'msbk_api_key',
                    'placeholder' => 'Enter your API key'
                ]
            ]
        ];

        $this->settings->setFields($args);
    }
}
