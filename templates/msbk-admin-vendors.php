<div class="wrap">

    <h1>MultiStripe by Keys</h1>
    <p>Voici un plugin permettant de connecter plusieurs compte Stripe à Woocommerce grâce au clefs APIs de chaque compte.</p>

    <h2>Vendors</h2>

    <?php include_once plugin_dir_path(__FILE__) . 'msbk-admin-navbar.php'; ?>

    <form method="post" action="options.php">

        <?php
        if (empty($_GET['tab'])) {
            $current_tab = '1';
        } else {
            $current_tab = substr(sanitize_title(wp_unslash($_GET['tab'])), -1);
        }
        settings_fields('msbk_options_vendors_group_' . $current_tab);
        do_settings_sections('msbk_vendor_' . $current_tab);
        submit_button();
        ?>
    </form>
</div>