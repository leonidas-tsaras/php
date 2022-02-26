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
 * Text Domain:       cooll-contact-form
 * Domain Path:       /languages
 */

if(!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

include('admin/AdminForm.class.php');
include('admin/AdminMenu.class.php');
include('public/ContactForm.class.php');
include('App.class.php');

new App();


