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

if (!class_exists('CNLF_Autoloader') ) {
    $root = dirname(__FILE__);
    include_once "$root/autoloader.class.php";
}

// create App class to store app variables
if (!class_exists('CNLF') ) {
    class CNLF {
        const SHORTCODE = 'cool-newsletter-form'; // holds shortcode name
        const NONCE_ACTION = 'cnlf_action';
        const NONCE_FIELD_NAME = 'cnlf_field_name';
    }
}

if(is_admin()) {
	new Admin();
} else {
	new User();
}



