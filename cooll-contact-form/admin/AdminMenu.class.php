<?php

class AdminMenu {
<<<<<<< HEAD
    function __construct() {
=======
    function __construct($slug) {
        $this->slug = $slug;
>>>>>>> 5458f02c131c590c2e53a30f7874cd7aca189e2c
        add_action('admin_menu', array($this, 'add_menu_page_callback'));
    }

    function add_menu_page_callback() {
        add_menu_page(
            'Contact Form Settings',
            'Contact Form',
            'manage_options',
<<<<<<< HEAD
            CCF::SLUG,
=======
            $this->slug,
>>>>>>> 5458f02c131c590c2e53a30f7874cd7aca189e2c
            array($this, 'options_page_html_callback')
        );
    }

    function options_page_html_callback() {
        // check user capabilities
        if (!current_user_can('manage_options')) {
            return;
        }
     
        // add error/update messages
     
        // check if the user have submitted the settings
        // WordPress will add the "settings-updated" $_GET parameter to the url
        if (isset($_GET['settings-updated'])) {
            // add settings saved message with the class of "updated"
<<<<<<< HEAD
            add_settings_error( '_messages', '_message', __('Settings Saved', CCF::TEXT_DOMAIN), 'updated');
        }

=======
            add_settings_error( '_messages', '_message', __('Settings Saved', 'cool-domain' ), 'updated');
        }
     
>>>>>>> 5458f02c131c590c2e53a30f7874cd7aca189e2c
        // show error/update messages
        settings_errors('_messages');
        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
            <form action = "options.php" method = "post">
                <?php
<<<<<<< HEAD
                settings_fields(CCF::SLUG);
                do_settings_sections(CCF::SLUG);
                submit_button(__('Save Settings', CCF::TEXT_DOMAIN));
=======
                settings_fields($this->slug);
                do_settings_sections($this->slug);
                submit_button(__('Save Settings', 'cool-domain'));
>>>>>>> 5458f02c131c590c2e53a30f7874cd7aca189e2c
                ?>
            </form>
        </div>
        <?php
    }
}
