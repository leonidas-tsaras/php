<?php
$_SESSION['token'] = bin2hex(random_bytes(32));
?>

<div id = "form-wrapper">
    <h3>Login</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "POST" onsubmit = "return validateLoginForm(this)">
        <input type = "email" name = "email" value = "<?php echo $email ?>" placeholder = "e-mail">
        <input type = "password" value = "<?php echo $password ?>" name = "password">
        <input type = "hidden" name = "token" value = "<?php echo $_SESSION['token'] ?>">
        <input type = "submit" value = "login">
    </form>
    <?php
        $class = "";
        if($method === "POST") {
            if($error) {
                $class = "error";
            } 
        }
    ?>
    <p class = "<?php echo $class ?>"><?php echo $error ?></p>
</div>