<?php

  $input = json_decode(file_get_contents('php://input'), true);
  $email = $input["email"];

  //sanitize data
  $email = filter_var($email, FILTER_SANITIZE_EMAIL);

  //validate data
  if(filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    exit(json_encode(["result" => "error: μη έγκυρο e-mail"]));
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
    
  } catch(PDOException $e) {
    echo json_encode(["result" => "oops, Connection failed"]);
  } finally {
    $conn = null;
    echo json_encode(["result" => "ok"]);
  }
  
