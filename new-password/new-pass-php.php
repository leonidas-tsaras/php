<?php
session_start();
//check if in session
if(!(isset($_SESSION['visitor']) && $_SESSION['visitor'] === session_id())) {
    header("Location: ./../login/login-php.php");
    die();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Password Form</title>
    <link rel="stylesheet" href="form-wrapper.css">
    <script>
        function validateNewPassForm(form) {
            try {
                let old_password = document.querySelector("div#form-wrapper > form > input[name='old_password']").value;
                if(old_password.length < 6) {
                    throw "oops, Fill out a valid Current Password";
                }

                let new_password = document.querySelector("div#form-wrapper > form > input[name='new_password']").value;
                if(new_password.length < 6) {
                    throw "oops, Fill out a valid New Password";
                }           

                let con_password = document.querySelector("div#form-wrapper > form > input[name='con_password']").value;
                if(con_password.length < 6) {
                    throw "oops, Fill out a valid Confirm Password";
                }

                if(new_password !== con_password)  {
                    throw "oops, New Password and Confirm Password don't match";
                }                
            } catch(error) {
                let p = document.querySelector("div#form-wrapper > p");
                p.className = "error";
                p.textContent = error;
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

<?php
$method = null;
$old_password = "";
$new_password = "";
$con_password = "";
$error = null;

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
        $old_password = $_POST["old_password"];
        $new_password = $_POST["new_password"];
        $con_password = $_POST["con_password"];
        $user_id = $_POST["user_id"];

        //sanitize data
        //$old_password = filter_var($old_password, FILTER_SANITIZE_STRING);
        //$new_password = filter_var($new_password, FILTER_SANITIZE_STRING);
        //$con_password = filter_var($con_password, FILTER_SANITIZE_STRING);

        //validate password
        if(strlen($old_password) < 6) {
            throw new Exception('oops, Fill out a valid Current Password');
        }
        if(strlen($new_password) < 6) {
            throw new Exception('oops, Fill out a valid New Password');
        }
        if(strlen($con_password) < 6) {
            throw new Exception('oops, Fill out a valid Confirm Password');
        }
        if(strlen($new_password !== $con_password)) {
            throw new Exception('oops, New Password and Confirm Password don\'t match');
        }
    } catch(Exception $e) {
        $error = $e->getMessage();
        include_once("new-pass-form.php");
        exit();
    }

    //connect to database
    require_once("config.php");
    
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //update db
    $sql = "UPDATE `user` SET `password`='$new_password' WHERE `user_id`='$user_id'";

    $stmt = $conn->prepare($sql);
    $stmt->execute();

    } catch(PDOException $e) {
        $error =  $e->getMessage();
    } catch(Exception $e) {
        $error =  $e->getMessage();
    } finally {
        $conn = null;
        if($error == null) {
            exit("password changed");
        }
    }
}

include_once("new-pass-form.php");
?>
</body>
</html>