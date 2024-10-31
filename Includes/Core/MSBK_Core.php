<?php

/**
 * @package MultiStripeByKeys
 */

namespace Includes\Core;

class MSBK_Core
{
    public function register()
    {
        if (get_option('is_activate_test_option') || get_option('is_activate_live_option')) {
            add_filter('wc_stripe_params', [$this, 'conditional_publishable_key'], 9999);

            add_filter('wc_stripe_payment_request_params', [$this, 'conditional_publishable_key_request'], 9999);

            add_filter('woocommerce_stripe_request_headers', [$this, 'conditional_private_key_headers'], 9999);
        }
    }

    public function conditional_publishable_key($params)
    {
        $publishable_key = '';
        if (get_option('is_activate_live_option')) {
            $publishable_key = $this->get_pk_live();
        }

        if (get_option('is_activate_test_option')) {
            $publishable_key = $this->get_pk_test();
        }

        if (!empty($publishable_key)) {
            $params['key'] = $publishable_key;
        }
        return $params;
    }

    public function conditional_publishable_key_request($params)
    {
        $publishable_key = '';
        if (get_option('is_activate_live_option')) {
            $publishable_key = $this->get_pk_live();
        }

        if (get_option('is_activate_test_option')) {
            $publishable_key = $this->get_pk_test();
        }

        if (!empty($publishable_key)) {
            $params['stripe']['key'] = $publishable_key;
        }
        return $params;
    }

    public function conditional_private_key_headers($headers_args)
    {
        $secret_key = '';
        if (get_option('is_activate_live_option')) {
            $secret_key = $this->get_pk_live();
        }

        if (get_option('is_activate_test_option')) {
            $secret_key = $this->get_pk_test();
        }

        if (!empty($secret_key)) {
            $headers_args['Authorization'] = 'Basic ' . base64_encode($secret_key . ':');
        }
        return $headers_args;
    }

    public function get_pk_live()
    {
        // Loop though cart items searching for the defined products
        if (!is_admin()) {
            foreach (WC()->cart->get_cart() as $cart_item) {
                // Product id
                $product_id = $cart_item['product_id'];
                $vendorId = false;
                // Return the vendor pk_live key matching vendor items
                if (!empty(get_option('list_products_selected'))) {
                    $listProductsSelected = get_option('list_products_selected');
                    foreach ($listProductsSelected as $key => $listProducts) {
                        if (is_array($listProducts)) {
                            $vendorId = array_search($product_id, $listProducts);
                        }
                    }
                    if (!empty(get_option('vendor_pk_live_option_' . $vendorId))) {
                        return get_option('vendor_pk_live_option_' . $vendorId);
                    }
                }
                return '';
            }
        }
    }

    public function get_sk_live()
    {
        // Loop though cart items searching for the defined products
        if (!is_admin()) {
            foreach (WC()->cart->get_cart() as $cart_item) {
                // Product id
                $product_id = $cart_item['product_id'];
                $vendorId = false;
                // Return the vendor sk_live key matching vendor items
                if (!empty(get_option('list_products_selected'))) {
                    $listProductsSelected = get_option('list_products_selected');
                    foreach ($listProductsSelected as $key => $listProducts) {
                        if (is_array($listProducts)) {
                            $vendorId = array_search($product_id, $listProducts);
                        }
                    }
                    if (!empty(get_option('vendor_sk_live_option_' . $vendorId))) {
                        return get_option('vendor_sk_live_option_' . $vendorId);
                    }
                }
                return '';
            }
        }
    }

    public function get_pk_test()
    {
        // Loop though cart items searching for the defined products
        if (!is_admin()) {
            foreach (WC()->cart->get_cart() as $cart_item) {
                // Product id
                $product_id = $cart_item['product_id'];
                $vendorId = false;
                // Return the vendor pk_test key matching vendor items
                if (!empty(get_option('list_products_selected'))) {
                    $listProductsSelected = get_option('list_products_selected');
                    foreach ($listProductsSelected as $listProducts) {
                        if (is_array($listProducts)) {
                            $vendorId = array_search($product_id, $listProducts);
                        }
                    }
                    if (!empty(get_option('vendor_pk_test_option_' . $vendorId))) {
                        return get_option('vendor_pk_test_option_' . $vendorId);
                    }
                }
                return '';
            }
        }
    }

    public function get_sk_test()
    {
        // Loop though cart items searching for the defined products
        if (!is_admin()) {
            foreach (WC()->cart->get_cart() as $cart_item) {
                // Product id
                $product_id = $cart_item['product_id'];
                $vendorId = false;
                // Return the vendor sk_test key matching vendor items
                if (!empty(get_option('list_products_selected'))) {
                    $listProductsSelected = get_option('list_products_selected');
                    foreach ($listProductsSelected as $key => $listProducts) {
                        if (is_array($listProducts)) {
                            $vendorId = array_search($product_id, $listProducts);
                        }
                    }
                    if (!empty(get_option('vendor_sk_test_option_' . $vendorId))) {
                        return get_option('vendor_sk_test_option_' . $vendorId);
                    }
                }
                return '';
            }
        }
    }
}
