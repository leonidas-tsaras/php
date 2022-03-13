<?php
ob_start();
?>
        <div class="contact-form-wrapper">
            <h2><?php echo __('Contact Form', CCF::TEXT_DOMAIN) ?></h2>
    <?php
            if($this->method == "POST") {
                if($this->error) {
                    echo "<p class = 'error'>$this->error</p>";
                } else {
                    $response = $this->sendContactForm($this->email, $this->fullname, $this->subject, $this->message);
                    if($response) {
                        echo "<p class = 'success'>";
                        echo __("Succes: Thanks for contacting me. I'll get back to you asap.", CCF::TEXT_DOMAIN);
                        echo "</p>";

                        $this->email = "";
                        $this->fullname = "";
                        $this->subject = "";
                        $this->message = "";
                    } else {

                        echo "<p class = 'error'>";
                        echo __("Oops, something went wrong, please try again or contact us through our info email.", CCF::TEXT_DOMAIN);
                        echo "</p>";
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
echo ob_get_clean();
?>
