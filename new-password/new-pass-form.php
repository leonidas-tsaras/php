<?php
$_SESSION['token'] = bin2hex(random_bytes(32));
?>

<div id = "form-wrapper">
    <h3>New Password</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "POST" onsubmit = "return validateNewPassForm(this)">
        <input type = "password" value = "<?php echo $old_password ?>" name = "old_password" placeholder = "Current Password">
        <input type = "password" value = "<?php echo $new_password ?>" name = "new_password" placeholder = "new_password Password">
        <input type = "password" value = "<?php echo $con_password ?>" name = "con_password" placeholder = "Confirm Password">
        <input type = "hidden" name = "token" value = "<?php echo $_SESSION['token'] ?>">
        <input type = "hidden" name = "user_id" value = "<?php echo $_SESSION['user_id'] ?>">
        <input type = "submit" value = "Submit">
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