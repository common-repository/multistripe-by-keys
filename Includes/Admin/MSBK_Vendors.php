<?php

/**
 * @package MultiStripeByKeys
 */

namespace Includes\Admin;

class MSBK_Vendors
{
    public $listOfVendors = [];

    public function __construct()
    {
    }

    public function register()
    {
        if (empty(get_option('number_vendor_option')) || get_option('number_vendor_option') === 0 || get_option('number_vendor_option') > 3) {
            update_option('number_vendor_option', 3);
        }

        for ($i = 1; $i <= get_option('number_vendor_option'); $i++) {

            $vendor = new MSBK_Vendor($i);

            array_push($this->listOfVendors, $vendor);

            if (empty(get_option('vendors_ids'))) {
                $vendorName = get_option('vendor_name_option_' . $i);

                add_option('vendors_ids', [$i => $vendorName]);
            } else {
                $vendorName = get_option('vendor_name_option_' . $i);
                $vendors_ids = get_option('vendors_ids');
                $vendors_ids = array_replace($vendors_ids, [$i => $vendorName]);

                update_option('vendors_ids', $vendors_ids);
            }

            if (empty(get_option('list_products_selected'))) {
                $listProductsVendor = get_option('vendor_list_product_option_' . $i);

                add_option('list_products_selected', [$i => $listProductsVendor]);
            } else {
                $listProductsVendor = get_option('vendor_list_product_option_' . $i);
                $listProductsVendors = get_option('list_products_selected');
                
                $listProductsVendors = array_replace($listProductsVendors, [$i => $listProductsVendor]);

                update_option('list_products_selected', $listProductsVendors);
            }
            
        }
    }
}
