<?php
/**
 * Plugin Name:       Cool News Letter Form
 * Plugin URI:        https://tutor.edu.gr/plugins/cool-form
 * Description:       Basic contact form plugin
 * Version:           0.1
 * Requires at least: 5.6
 * Requires PHP:      7.4
 * Author:            leonidas.tsaras@gmail.com
 * Author URI:        https://tutor.edu.gr
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://tutor.edu.gr/plugins/cool-newsletter-form
 * Text Domain:       cnlf
 * Domain Path:       /local
 */

// Exit if accessed directly
if (!defined('ABSPATH')) exit;

// register autoloading
spl_autoload_register(function ($class_name) {
    $root = dirname(__FILE__);
    $dirs = ["admin", "user"];
    foreach($dirs as $dir) {
        $file = $root . '/' . $dir . '/' . $class_name . '.class.php';
        if(file_exists($file)) {
            require_once($file);
            return;
        }
    }
});

// create App class to store app variables
class App {
    const SHORTCODE = 'cool-newsletter-form'; // holds shortcode name
    const NONCE_ACTION = 'cnlf_action';
    const NONCE_FIELD_NAME = 'cnlf_field_name';
}

if(is_admin()) {
	new Admin();
} else {
	new User();
}

