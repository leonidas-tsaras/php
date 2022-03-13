<!-- inserted by user class -->
<div class="cnf-form-wrapper">
    <h2>Newsletter Form</h2>
    <?php
        if($method == "POST") {
            if($error) {
                echo "<p class = 'error'>$error</p>";
            } else {
                $response = $this->sendRegistrationEmail($email);
                if($response) {
                    echo "<p class = 'success'>Succes: Thanks for registering to our emailing list</p>";
                    $email = "";
                } else {
                    echo "<p class = 'error'>oops, something went wrong, please try again or contact us through our info email.</p>";
                }
            }
        }
    ?>
    <form method = 'POST' action = "<?php echo htmlspecialchars($_SERVER['REQUEST_URI']); ?>">
        <input type = 'email' value = '' name = 'email' placeholder = 'e-mail'>
        <?php wp_nonce_field(CNLF::NONCE_ACTION, CNLF::NONCE_FIELD_NAME); ?>
        <input type = 'submit'>
    </form>
</div>
