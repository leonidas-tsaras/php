<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="form-wrapper.css">

    <script>
        function validateNewsletterForm(form) {
            //read values
            let email = form.querySelector("input[type='email']").value;

            //validation
            const mailformat = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            if(!email.match(mailformat)) {
                let p = document.querySelector("div#form-wrapper > p");
                p.className = "error";
                p.textContent = "oops, Συμπληρώστε ένα έγκυρο e-mail";
                return false;
            }
            return true;
        }

    </script>
</head>
<body>

<?php

$error = "";
$email = "";
$method = $_SERVER['REQUEST_METHOD'];

if($method === "POST") {

    //read data
    $email = $_POST["email"];

    //sanitize data
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    //validate data
    if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $error = "error: μη έγκυρο e-mail";
    }

  //connect  to db
  require_once("config.php");
    
  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      //insert into db
      $sql = "INSERT INTO `newsletter` (`email`) VALUES ('$email')";

      //$conn->exec($sql);
      $stmt = $conn->prepare($sql);
      $stmt->execute();
  }
  catch(PDOException $e) {
    $error =  "Connection failed: " . $e->getMessage();
  }
  $conn = null;

    if($error === "") $email = "";
}
?>

<div id = "form-wrapper">
    <h3>Newsletter</h3>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method = "POST" onsubmit = "return validateNewsletterForm(this)">
        <input type = "email" name = "email" value = "<?php echo $email ?>" placeholder = "e-mail">
        <input type = "submit" value = "Εγγραφή">
    </form>
    <?php
        $class = $msg = "";
        if($method === "POST") {
            if($error) $class = "error";
            else {
                $class = "success";
                $msg = "Ευχαριστούμε για την εγγραφή σας";
            }
        }
    ?>
    <p class = "<?php echo $class ?>"><?php echo $msg ?></p>
</div>
</body>
</html>