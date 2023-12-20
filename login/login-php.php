<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form PHP</title>
    <link rel="stylesheet" href="form-wrapper.css">
    <script>
        function validateLoginForm(form) {
            //read email
            let email = form.querySelector("input[type='email']").value;

            //validation
            const mailformat = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            if(!email.match(mailformat)) {
                let p = document.querySelector("div#form-wrapper > p");
                p.className = "error";
                p.textContent = "oops, Συμπληρώστε ένα έγκυρο e-mail";
                return false;
            }

            let password = document.querySelector("div#form-wrapper > form > input[type='password']").value;
            if(password.length < 6) {
                let p = document.querySelector("div#form-wrapper > p");
                p.className = "error";
                p.textContent = "oops, Συμπληρώστε ένα έγκυρο password";
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

<?php
$method = null;
$error = "";
$email = "";
$password = "";

if(isset($_SERVER['REQUEST_METHOD'])) $method = $_SERVER['REQUEST_METHOD'];
if($method === "POST") {
    try {
        //check for token
        if(isset($_POST['token']) && isset($_SESSION['token'])) {
            if($_POST['token'] !== $_SESSION['token']) {
                throw new Exception('oops, wrong token');
            }
        } else {
            throw new Exception('oops, no security token');
        }

        //read data
        $email = $_POST["email"];
        $password = $_POST["password"];

        //sanitize data
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $password = filter_var($password, FILTER_SANITIZE_STRING);

        //validate email
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('oops, Fill out a valid e-mail');
        }

        //validate password
        if(strlen($password) < 6) {
            throw new Exception('oops, Fill out a valid password');
        }
    } catch(Exception $e) {
        $error = $e->getMessage();
        include_once("login-form.php");
        exit();
    }

    //connect to database
    require_once("config.php");
    
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //select from db
    $sql = "SELECT `email`, `password` FROm `user` WHERE `email` = '$email' AND `password` = '$password'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    if(count($result) > 0) {
        //set user in session
        //session_start();
        $_SESSION['visitor'] = session_id();
        header("Location: ./welcome.php");
        die();
    } else {
        throw new Exception('oops, wrong credentials, please try again');
    }
    } catch(PDOException $e) {
        $error =  $e->getMessage();
    } catch(Exception $e) {
        $error =  $e->getMessage();
    }
    $conn = null;
}

include_once("login-form.php");
?>
</body>
</html>