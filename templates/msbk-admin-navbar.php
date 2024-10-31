<nav class="nav-tab-wrapper">
    <?php
    if ($_GET['page'] === 'msbk_admin') {
        $current_tab = 'general';
    }else {
        $current_tab = empty($_GET['tab']) ? 'vendor-1' : sanitize_title(wp_unslash($_GET['tab']));
    }
    

    $tabs = [
        'general' => 'General'
    ];

    if (isset($_POST['add_vendor']) && get_option('number_vendor_option') < 3) {
        $number_vendor = get_option('number_vendor_option');
        update_option('number_vendor_option', $number_vendor + 1);
    }

    for ($i = 1; $i <= get_option('number_vendor_option'); $i++) {
        $tabs['vendor-'.$i] = (!empty(get_option('vendor_name_option_' . $i)) ? get_option('vendor_name_option_' . $i) : 'Vendor ' . $i);
    }

    

    foreach ($tabs as $slug => $label) {
        echo '<a 
        href="' . esc_html(admin_url('admin.php?page=' . ($slug === 'general' ? 'msbk_admin' : 'msbk_vendors') . '&tab=' . esc_attr($slug))) . '" 
        class="nav-tab ' . ($current_tab === $slug ? 'nav-tab-active' : '') . '">' . esc_html($label) . '</a>';
    }


    ?>
    <form method="post">
        <input type="submit" name="add_vendor" value="+" class="nav-tab">
    </form>
</nav>