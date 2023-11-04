<?php 
	session_start();
	 function redirect($slug,$message)
	{
		$redirectTo = "http://localhost/php_project/my-studentAttendanceSystem/".$slug;
		$_SESSION['msg'] = $message;
		header("location: $redirectTo");
		exit(0);
	}

?>