<?php
session_start();
$errors = [];
if(isset($_SESSION['auth'])){
    if($_SESSION['auth']){
        header("Location: /");
    }
}

if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}

$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
$_SESSION['user-agent'] = $_SERVER['HTTP_USER_AGENT'];

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if($_POST['token'] == $_SESSION['token']) {
        if (($_POST['username'] == 'user') and ($_POST['password'] == 'pass')) {
            $_SESSION['auth'] = True;
            header('Location: /');
        } else {
            $_SESSION['auth'] = False;
            $errors[] = 'Username/Password combination invalid.';
        }
    } else {
        $errors[] = 'CSRF token does not match';
    }
}
?>

<form action="" method="post">
    <input type="text" placeholder="Username" name="username" value="<?php
        if(isset($_POST['username'])){
            echo $_POST['username'];
        }
    ?>" required/>
    <input type="password" placeholder="Password" name="password" required/>
    <input type="hidden" name="token" value="<?php echo $_SESSION['token'];?>" required/>
    <input type="submit" placeholder="Log in">
</form>
<?php
    if(count($errors) > 0){
        foreach($errors as $error){?>
            <span style="color:red;"><?php echo $error; ?></span>
        <?php }
    }
?>
<p>Don't have an account? <a href="#">Create an account</a></p>
