<div class="wrap">

    <h1>MultiStripe by Keys</h1>
    <p>The ideal tool for all marketplaces, e-commerce or franchise wishing to have a common collection solution with individual payments for each vendor.</p>

    <?php settings_errors(); ?>

    <h2>General</h2>

    <?php include_once plugin_dir_path(__FILE__) . 'msbk-admin-navbar.php'; ?>

    <form method="post" id="mainframe" action="options.php">
        <?php
        settings_fields('msbk_options_group');
        do_settings_sections('msbk_admin');
        submit_button();
        ?>
    </form>
</div>