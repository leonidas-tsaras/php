<?php
class User {
     
    function __construct() {
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_shortcode(App::SHORTCODE, array($this, 'addshortcode'));
    }

    function activate() {
        // activation code here
    }

    function deactivate() {
        // deactivation code here
    }

	function enqueue_scripts() {
		wp_enqueue_style('form-styles',  plugin_dir_url(__FILE__) . 'css/form.css');
		wp_enqueue_script('form-script',  plugin_dir_url(__FILE__) . 'js/form.js');
	}

	function addshortcode() {
        $method = $_SERVER["REQUEST_METHOD"];
        $error = $email = "";

        if($method === 'POST') {
            // validate e-mail
            $email = $this->test_input($_POST["email"]);
            if($this->validateEmail($email) === false) {
                $error = "Please enter a valid e-mail";
            }

            // check nonce
            if ( ! isset( $_POST[App::NONCE_FIELD_NAME] ) || ! wp_verify_nonce($_POST[App::NONCE_FIELD_NAME], App::NONCE_ACTION)) {
                $error = 'Sorry, your nonce did not verify.';
            }
        }
		require_once __DIR__ . '/form.php';
	}

    private function sendRegistrationEmail($email) {
        $to = get_option('cnf-email', get_bloginfo('admin_email'));
        $body = "Registration e-mail: $email";
        $fullName = "";

        //$to = 'leonidas.tsaras@example.com';
        $subject = 'Registration';
        $headers = array('Content-Type: text/html; charset=UTF-8', "From: $fullName <$email>", "Reply-To: $fullName <$email>");

        return wp_mail($to, $subject, $body, $headers);
        //return true;
    }

    private function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    private function validateEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }
}