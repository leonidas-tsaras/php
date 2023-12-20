<?php

$input = json_decode(file_get_contents('php://input'), true);
if(isset($input)) {
  $fname = $input["fname"];
  $lname = $input["lname"];
  $email = $input["email"];
  $phone = $input["phone"];
} else {
  exit(json_encode(["result" => "error: Wrong data"]));
}

//sanitize data
$fname = filter_var($fname, FILTER_SANITIZE_STRING);
$lname = filter_var($lname, FILTER_SANITIZE_STRING);
$email = filter_var($email, FILTER_SANITIZE_EMAIL);

//validate data
if($fname === "") exit(json_encode(["result" => "error: Not a valid first name"]));
if($lname === "") exit(json_encode(["result" => "error: Not a valid last name"]));
if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
  exit(json_encode(["result" => "error: Not a valid e-mail"]));
}
if(strlen($phone) < 10) exit(json_encode(["result" => "error: Not a valid phone"]));

//connect  to db
require_once("config.php");

$error = "";
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  //insert into db
  $password = "abc123";
  $sql = "INSERT INTO `user` (`first_name`, `last_name`, `email`, `password`, `phone`) VALUES ('$fname', '$lname', '$email', '$password', '$phone')";

  //$conn->exec($sql);
  $stmt = $conn->prepare($sql);
  $stmt->execute();
} catch(PDOException $e) {
  $error = "error: Connection failed";
} finally {
  $conn = null;
  if($error)
    echo json_encode(["result" => $error]);
  else {
    // send e-mail for confirmation
    echo json_encode(["result" => "ok"]);    
  }
}
