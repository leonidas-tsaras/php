<?php
/**
 * Plugin Name:       Cooll Contact Form
 * Plugin URI:        https://tutor.edu.gr/plugins/cooll-contact-form
 * Description:       Basic class contact form plugin
 * Version:           1.0
 * Requires at least: 5.6
 * Requires PHP:      7.4
 * Author:            Leonidas Tsaras
 * Author URI:        https://tutor.edu.gr
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://tutor.edu.gr/plugins/cool-class-form
<<<<<<< HEAD
 * Text Domain:       ccf-domain
=======
 * Text Domain:       cooll-contact-form
>>>>>>> 5458f02c131c590c2e53a30f7874cd7aca189e2c
 * Domain Path:       /languages
 */

if(!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

<<<<<<< HEAD
// register autoloading
spl_autoload_register(function ($class_name) {
    $root = dirname(__FILE__);
    $dirs = ["admin", "public"];
    foreach($dirs as $dir) {
        $file = $root . '/' . $dir . '/' . $class_name . '.class.php';
        if(file_exists($file)) {
            require_once($file);
            return;
        }
    }
});

class CCF {
    const SLUG = 'ccf'; // slug-name, page name, group name
    const OPTIONS = 'ccf_options'; // option data to sanitize and save
    const SHORTCODE = 'cooll-contact-form';
    const TEXT_DOMAIN = 'ccf-domain';
    function __construct() {
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
    }

    function activate() {
        // activation code here
    }

    function deactivate() {
        // deactivation code here
    }
}


new CCF();

if(is_admin()) {
    new AdminForm();
    new AdminMenu();
} else {
    new ContactForm();
}
=======
include('admin/AdminForm.class.php');
include('admin/AdminMenu.class.php');
include('public/ContactForm.class.php');
include('App.class.php');

new App();


>>>>>>> 5458f02c131c590c2e53a30f7874cd7aca189e2c
