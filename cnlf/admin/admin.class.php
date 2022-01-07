<?php

class Admin {
	private static $option_value;
	const OPTION_KEY = 'cnlf-email'; // option data to sanitize and save

	function __construct() {
		add_action('admin_menu', array($this, 'add_menu_page'));
	}

	function form_options_page_html() {
		if('POST' === $_SERVER['REQUEST_METHOD'] && !empty($_POST['email-submit'])) {
			self::$option_value = $_POST['email-submit'];
			update_option(self::OPTION_KEY, self::$option_value);
		} else {
			self::$option_value = get_option(self::OPTION_KEY, get_bloginfo('admin_email'));
		}
		require_once __DIR__ . '/form.php';
	}

	function add_menu_page() {
		add_menu_page(
			"Cool Newsletter Settings", //get_admin_page_title
			"Cool Newsletter Form", // admin side menu title
			"manage_options",
			"cool-newsletter-slug", // page slug
			//"cnf_form_options_page_html",
			array($this, 'form_options_page_html'), // callback functions
			plugin_dir_url(__FILE__) . 'images/cool-form-icon.svg' // menu icon
		);
	}
}
