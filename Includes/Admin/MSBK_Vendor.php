<?php

/**
 * @package MultiStripeByKeys
 */

namespace Includes\Admin;

use Includes\Api\Callbacks\VendorCallbacks;
use Includes\Api\MSBK_SettingsApi;

class MSBK_Vendor
{
    public $settingsapi;

    public $callbacks;

    private $idVendor;

    /**
     * Constructor for a vendor by id
     */
    public function __construct($id)
    {
        $this->settingsapi = new MSBK_SettingsApi();

        $this->callbacks = new VendorCallbacks();

        $this->idVendor = $id;

        $this->setVendorSettings();
        $this->setSections();
        $this->setFields();

        $this->settingsapi->register();
    }

    /**
     * Set the settings for vendor parameters
     */
    public function setVendorSettings()
    {
        $args = [
            [
                'option_group' => 'msbk_options_vendors_group_' . $this->idVendor,
                'option_name' => 'vendor_name_option_' . $this->idVendor,
                'callback' => [$this->callbacks, 'msbkVendorGroup']
            ],
            [
                'option_group' => 'msbk_options_vendors_group_' . $this->idVendor,
                'option_name' => 'vendor_pk_test_option_' . $this->idVendor
            ],
            [
                'option_group' => 'msbk_options_vendors_group_' . $this->idVendor,
                'option_name' => 'vendor_sk_test_option_' . $this->idVendor
            ],
            [
                'option_group' => 'msbk_options_vendors_group_' . $this->idVendor,
                'option_name' => 'vendor_pk_live_option_' . $this->idVendor
            ],
            [
                'option_group' => 'msbk_options_vendors_group_' . $this->idVendor,
                'option_name' => 'vendor_sk_live_option_' . $this->idVendor
            ],
            [
                'option_group' => 'msbk_options_vendors_group_' . $this->idVendor,
                'option_name' => 'vendor_list_product_option_' . $this->idVendor
            ]
        ];

        $this->settingsapi->setSettings($args);
    }

    /**
     * Set the sections for vendor parameters
     */
    public function setSections()
    {
        $args = [
            [
                'id' => 'msbk_vendor_index_' . $this->idVendor,
                'title' => '',
                'callback' => [$this->callbacks, 'msbkVendorSection'],
                'page' => 'msbk_vendor_' . $this->idVendor
            ]
        ];

        $this->settingsapi->setSections($args);
    }

    /**
     * Set the fields for vendor parameters
     */
    public function setFields()
    {
        $args = [
            [
                'id' => 'vendor_name_option_' . $this->idVendor,
                'title' => 'Vendor ' . $this->idVendor . ' Name :',
                'callback' => [$this->callbacks, 'vendorTextCallback'],
                'page' => 'msbk_vendor_' . $this->idVendor,
                'section' => 'msbk_vendor_index_' . $this->idVendor,
                'args' => [
                    'label_for' => 'vendor_name_option_' . $this->idVendor,
                    'class' => 'example-class',
                    'id' => $this->idVendor,
                    'placeholder' => 'Vendor Name'
                ]
            ],
            [
                'id' => 'vendor_pk_test_option_' . $this->idVendor,
                'title' => 'Public Test Key :',
                'callback' => [$this->callbacks, 'vendorTextCallback'],
                'page' => 'msbk_vendor_' . $this->idVendor,
                'section' => 'msbk_vendor_index_' . $this->idVendor,
                'args' => [
                    'label_for' => 'vendor_pk_test_option_' . $this->idVendor,
                    'class' => 'example-class',
                    'id' => $this->idVendor,
                    'placeholder' => 'Public Key for testing'
                ]
            ],
            [
                'id' => 'vendor_sk_test_option_' . $this->idVendor,
                'title' => 'Secret Test Key :',
                'callback' => [$this->callbacks, 'vendorPasswordCallback'],
                'page' => 'msbk_vendor_' . $this->idVendor,
                'section' => 'msbk_vendor_index_' . $this->idVendor,
                'args' => [
                    'label_for' => 'vendor_sk_test_option_' . $this->idVendor,
                    'class' => 'example-class',
                    'id' => $this->idVendor,
                    'placeholder' => 'Secret Key for testing'
                ]
            ],
            [
                'id' => 'vendor_pk_live_option_' . $this->idVendor,
                'title' => 'Public Live Key :',
                'callback' => [$this->callbacks, 'vendorTextCallback'],
                'page' => 'msbk_vendor_' . $this->idVendor,
                'section' => 'msbk_vendor_index_' . $this->idVendor,
                'args' => [
                    'label_for' => 'vendor_pk_live_option_' . $this->idVendor,
                    'class' => 'example-class',
                    'id' => $this->idVendor,
                    'placeholder' => 'Public Key for live'
                ]
            ],
            [
                'id' => 'vendor_sk_live_option_' . $this->idVendor,
                'title' => 'Secret Live Key :',
                'callback' => [$this->callbacks, 'vendorPasswordCallback'],
                'page' => 'msbk_vendor_' . $this->idVendor,
                'section' => 'msbk_vendor_index_' . $this->idVendor,
                'args' => [
                    'label_for' => 'vendor_sk_live_option_' . $this->idVendor,
                    'class' => 'example-class',
                    'id' => $this->idVendor,
                    'placeholder' => 'Secret Key for live'
                ]
            ],
            [
                'id' => 'vendor_list_product_option_' . $this->idVendor,
                'title' => 'List of product :',
                'callback' => [$this->callbacks, 'vendorSelectCallback'],
                'page' => 'msbk_vendor_' . $this->idVendor,
                'section' => 'msbk_vendor_index_' . $this->idVendor,
                'args' => [
                    'label_for' => 'vendor_list_product_option_' . $this->idVendor,
                    'class' => 'example-class',
                    'id' => $this->idVendor,
                    'placeholder' => 'List of product for this vendor',
                    'is_list_product' => 'true'
                ]
            ]
        ];

        $this->settingsapi->setFields($args);
    }
}
