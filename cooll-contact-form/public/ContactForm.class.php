<?php

class ContactForm {
    private $method;
    private $error, $fullname, $subject, $message, $email;
    function __construct() {
        add_shortcode(App::SHORTCODE, array($this, 'add_shortcode_callback'));
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts_callback'));
    }

    function add_shortcode_callback() {
        $this->method = $_SERVER["REQUEST_METHOD"];
        $this->error = $this->email = $this->fullname = $this->subject = $this->message = "";
        if($this->method === 'POST') {
            $this->email = $this->test_input($_POST["email"]);
            if($this->validateEmail($this->email) === false) {
                $this->error = "Please enter a valid e-mail";
            }
            $this->fullname = $this->test_input($_POST["fullname"]);
            $this->subject = $this->test_input($_POST["subject"]);
            $this->message = $this->test_input($_POST["message"]);
        }
        echo $this->getFormHtml();
    }

    function getFormHtml() {
        ob_start();
    ?>
        <div class="contact-form-wrapper">
            <h2>Contact Form</h2>
    <?php
            if($this->method == "POST") {
                if($this->error) {
                    echo "<p class = 'error'>$this->error</p>";
                } else {
                    $response = $this->sendRegistrationEmail($this->email, $this->fullname, $this->subject, $this->message);
                    if($response) {
                        echo "<p class = 'success'>Succes: Thanks for contacting me. I'll get back to you asap.</p>";
                        $this->email = "";
                        $this->fullname = "";
                        $this->subject = "";
                        $this->message = "";
                    } else {
                        echo "<p class = 'error'>oops, something went wrong, please try again or contact us through our info email.</p>";
                    }
                }
            }
    ?>
            <form method = 'POST' action = "<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">

            <section class = "form-email">
            <p>E-mail:</p>
            <p><input type = 'email' value = "<?php echo $this->email ?>" name = 'email' required></p>
            </section>

            <section class = "form-fullname">
            <p>Full name:</p>
            <p><input type = "text"  name = "fullname" value = "<?php echo $this->fullname ?>" required></p>
            </section>

            <section class = "form-subject">
            <p>Subject:</p>
            <p><input type = "text" name = "subject" value = "<?php echo $this->subject ?>" required></p>
            </section>

            <section class = "form-message">
            <p>Message:</p>
            <p><textarea rows = "5" name = "message" required><?php echo $this->message ?></textarea></p>
            </section>

            <section class = "form-submit">
            <p><input type = 'submit' name = "submit" value = "Submit"></p>
            </section>
            </form>
        </div>
    <?php
        return ob_get_clean();
    }

    function enqueue_scripts_callback() {
        wp_enqueue_style('form-styles',  plugin_dir_url( __FILE__ ) . '../public/css/form.css');
        wp_enqueue_script('form-script',  plugin_dir_url( __FILE__ ) . '../public/js/form.js');
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function validateEmail($email) {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }
        return true;
    }

    function sendRegistrationEmail($email, $fullname, $subject, $message) {
        $options = get_option(App::OPTIONS);
        $to = $options['email'];
        $body = "<p><b>Name:</b> $fullname</p>";
        $body .= "<p><b>Subject:</b> $subject</p>";
        $body .= "<p><b>Message:</b> $message</p>";

        $headers = array('Content-Type: text/html; charset=UTF-8', "From: $fullname <$email>", "Reply-To: $fullname <$email>");
    
        return wp_mail($to, $subject, $body, $headers);
    }
}
