<?php
   session_start();
   
   if(session_destroy()) {
      header("Location: ../loginpage.php");
   }
   if (isset($_GET['status']) and ($_GET["status"])=="client")
   {
	   session_start();
   
		if(session_destroy()) {
		header("Location: ../client/loginpage.php");
   }
}
?>
