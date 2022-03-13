<<<<<<< HEAD

<?php 
// if uninstall.php is not called by WordPress, die
if (!defined('WP_UNINSTALL_PLUGIN')) {
	die;
}

$options = CCF::OPTIONS;

delete_option($options);
=======
<?php

defined('WP_UNINSTALL_PLUGIN') || exit;
>>>>>>> 5458f02c131c590c2e53a30f7874cd7aca189e2c
