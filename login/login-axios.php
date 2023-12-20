<?php

    $error = "";
    $email = "";
    $password = "";

    //read data
    $input = json_decode(file_get_contents('php://input'), true);
    $email = $input["email"];
    $password = $input["password"];

    //sanitize data
    $email = filter_var($email, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);

    //validate email
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(["result" => "oops, Συμπληρώστε ένα έγκυρο e-mail"]);
        exit();
    }
        
    //check password
    if(strlen($password) < 6) {
        echo json_encode(["result" => "oops, Συμπληρώστε ένα έγκυρο password"]);
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
            session_start();
            $_SESSION['visitor'] = session_id();
        } else {
            $error = "Λάθος δεδομένα, προσπαθήστε πάλι";
        }
    } catch(PDOException $e) {
        $error = "oops, Connection failed";
    } finally {
        $conn = null;
        if($error) 
            echo json_encode(["result" => $error]);
        else {
            echo json_encode(["result" => "ok"]);
        }
    }

