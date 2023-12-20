<?php
	session_start();
	if(isset($_SESSION['visitor']) && $_SESSION['visitor']===session_id()) {
		echo "welcome";
        //include("user-page.php");
	} else {
		//echo "sorry not in session";
        header("Location: ./login-php.php");
        die();
 	}
?>