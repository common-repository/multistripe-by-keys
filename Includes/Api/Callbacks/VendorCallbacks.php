<?php

/**
 * @package MultiStripeByKeys
 */

namespace Includes\Api\Callbacks;

class VendorCallbacks
{
    public function msbkVendorGroup($input)
    {
        return $input;
    }

    public function msbkVendorSection()
    {
    }

    public function vendorTextCallback($input)
    {
        $ref = esc_attr($input['label_for']);
        $value = esc_attr(get_option($ref));
        echo '<input 
        type="text" 
        class="regular-text" 
        name="' . $ref . '" 
        value="' . $value . '" 
        placeholder="' . (isset($input['placeholder']) ? esc_attr($input['placeholder']) : '') . '">';
    }

    public function vendorPasswordCallback($input)
    {
        $ref = esc_attr($input['label_for']);
        $value = esc_attr(get_option($ref));
        echo '<input 
        type="password" 
        class="regular-text" 
        name="' . $ref . '" 
        value="' . $value . '" 
        placeholder="' . (isset($input['placeholder']) ? esc_attr($input['placeholder']) : '') . '">';
    }

    public function vendorSelectCallback($input)
    {
        $ref = esc_attr($input['label_for']);
        $values = get_option($ref);
        $products = [];
        echo '<select 
        class="regular-text" 
        name="' . $ref . '[]"
        id="' . $ref . '"
        placeholder="' . (isset($input['placeholder']) ? esc_attr($input['placeholder']) : '') . '" multiple="multiple">';
        if (!empty($input['is_list_product'])) {
            $products = $this->getListProducts();
            $listProductsSelected = $this->getListProductsSelected($input['id']);
            foreach ($products as $product) {
                if (array_search($product->get_id(), $listProductsSelected) === false) {
                    if (!empty($values)) {
                        $selected = (in_array($product->get_id(), $values)) ? 'selected' : '';
                    }
                    echo "<option value='" . esc_attr($product->get_id()) . "' $selected> " . esc_attr($product->get_name()) . " </option>";
                }
            }
        }
        echo '</select>';
    }

    private function getListProducts()
    {
        $args = array(
            'limit' => -1,
            'status' => 'publish',
            'return' => 'objects',
            'orderby'  => 'name'
        );
        return wc_get_products($args);
    }

    private function getListProductsSelected($id)
    {
        $listToReturn = [];
        if (!empty(get_option('list_products_selected'))) {
            $listProductsSelected = get_option('list_products_selected');
            foreach ($listProductsSelected as $key => $listProductsSelectdByVendor) {
                if (!empty($listProductsSelectdByVendor) && $key !== $id) {
                    $listToReturn = array_merge($listToReturn, $listProductsSelectdByVendor);
                }
            }
        }
        return $listToReturn;
    }
}
