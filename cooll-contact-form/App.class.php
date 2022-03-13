<?php

class App {
    const SLUG = 'ccf'; // slug-name, page name, group name
    const OPTIONS = 'ccf_options'; // option data to sanitize and save
    const SHORTCODE = 'cool-contact-form';
    function __construct() {
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));

        new AdminForm(self::SLUG, self::OPTIONS);
        new AdminMenu(self::SLUG);
        new ContactForm(self::SHORTCODE);
    }

    function activate() {
        // activation code here
    }

    function deactivate() {
        // deactivation code here
    }
}